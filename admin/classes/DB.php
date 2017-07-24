 <?php

class db {
    public $server = 'localhost';
    public $user = 'phimu_db';
    public $passwd = 'Krayzie23!';
    public $db = 'phimu';
    public $dbCon;

    function __construct(){
        $this->dbCon = mysqli_connect($this->server, $this->user, $this->passwd, $this->db);
    }

    function __destruct(){
        $this->dbCon->close();
    }

    function addSubject() {
        $sub = mysqli_real_escape_string($this->dbCon, $_POST['subject_name']);

        $sql = "INSERT INTO subjects (subject_name) VALUES ('".$sub."')";

        if ($this->dbCon->query($sql) === TRUE) {
            echo $_POST['subject_name'];
        } else {
            echo "Error: " . $sql . "<br>" . $this->dbCon->error;
        }
    }

    function selectSubjects() {
        $myQuery = "SELECT id, subject_name FROM subjects ORDER BY subject_name ASC;";
        $results = mysqli_query($this->dbCon, $myQuery);
        return $results;
    }

    public function getFolderTreeBySubject($subjectID) {         
        $flatTree = $this->getFlatFolderTreeDataFromDatabase($subjectID);
        $structuredTree = $this->generateStructuredFolderTree($flatTree);
        return $structuredTree;
    }

    public function getFlatFolderTreeDataFromDatabase($subjectID) {
	
        $sql = "SELECT
                    id,
                    subject_id,
                    label,
                    parent_folder_id,
                    url,
                    resource_type_id,
                    parent_folder_id,
                    display_order
                FROM
                    folderTree
                WHERE
                        subject_id = {$subjectID}";
        
        $sql .= " ORDER BY
                    hierarchy_level ASC,
                    parent_folder_id,
                    display_order ASC";

                    
        $results = mysqli_query($this->dbCon, $sql);
        
        $indexedResults = array();
        
        
      while($row = mysqli_fetch_assoc($results)){
         if ($row['resource_type_id'] == 1) {
                $row["children"] = array();
            }
            $id = $row["id"];
            $indexedResults[$id] = $row;
      }

        return $indexedResults;
    }

    public function generateStructuredFolderTree($flatTree){
        $structuredTree = array();
        foreach ($flatTree as $resource) {
            $this->recursivelyAddResourceToFolderTreeStructure($resource, $structuredTree);
        }
        return $structuredTree;
    }

    private function recursivelyAddResourceToFolderTreeStructure($resource, &$currentScope) {
        $isResourceInserted = false;
        if ( ! $resource["parent_folder_id"]) {
            $currentScope[] = $resource;
            $isResourceInserted = true;
        } else {
            foreach ($currentScope as &$resourceInScope) {
                if ($resourceInScope["resource_type_id"] == 1) {
                    if ($resourceInScope["id"] == $resource["parent_folder_id"]) {
                        $resourceInScope["children"][] = $resource;
                        $isResourceInserted = true;
                        break;
                    } else {
                        $isResourceInserted = $this->recursivelyAddResourceToFolderTreeStructure($resource, $resourceInScope["children"]);
                        if ($isResourceInserted) {
                            break;
                        }
                    }
                }
            }
        }
        return $isResourceInserted;
    }
    
    
    public function make_tree() {
        $tree = $_POST['tree'];
		$subject = $_POST['subject'];
		$hierarchy = json_decode($tree, true);
		
		$arr = $this->update_tree($subject, $hierarchy); 
		$this->updateFolderTree($arr, $subject);
    }
    
    private function update_tree($subject, $hierarchy, $level = 1) {
        $flatArray = array();
        foreach ($hierarchy as $key => $value) {
            
            $flatArray[] = array(
                'id' => $value['id'],
                'subject_id' => $subject,
                'label' => $value['name'],
                'resource_type_id' => $value['resource_type_id'],
                'embed_code' => $value['embed_code'],
                'parent_folder_id' => $value['parent_folder_id'],
                'display_order' => $key + 1,
                'hierarchy_level' => $level
            );
        
			// Loops through each element. If element again is array, function is recalled. 
            if (isset($value['children']) && is_array($value['children'])) {
                $x = $this->update_tree($subject, $value['children'], $level+1, $value['id']);
                $flatArray = array_merge($flatArray, $x);
            }
    	}
    	
		return $flatArray;
    }
    
    private function prepareExistingIDs($subjectID = 1) {
        if (!isset($this->subjectIDs[$subjectID])) {
            // initialize
            $sql = "SELECT id FROM folderTree WHERE subject_id = {$subjectID}";
            $query = mysqli_query($this->dbCon, $sql);
            
            while($row = mysqli_fetch_assoc($query)){
	            $this->subjectIDs[$subjectID][] = $row['id'];
	        }
            
        }
    }
    
    private function updateFolderTree($newTree, $subjectID) {
        $this->prepareExistingIDs($subjectID);
        $newIDs = array();
        
        // Update altered items
        foreach($newTree as $t) {
            array_push($newIDs, $t['id']);
            
            if(in_array($t['id'], $this->subjectIDs[$subjectID])) {
              $sql = "UPDATE folderTree SET label = '{$t['label']}', embed_code = '{$t['embed_code']}', parent_folder_id = {$t['parent_folder_id']}, hierarchy_level = {$t['hierarchy_level']}, resource_type = '{$t['resource_type']}', display_order = {$t['display_order']} WHERE id = {$t['id']} AND subject_id = {$subjectID}";
              
              $query = mysqli_query($this->dbCon, $sql);
              
              if(($key = array_search($t['id'], $this->subjectIDs[$subjectID])) !== false) {
                  unset($this->subjectIDs[$subjectID][$key]);
              }
              
              if(($key = array_search($t['id'], $newIDs)) !== false) {
                  unset($newIDs[$key]);
              }
              
            }
            
        }
        
        // Insert new items
        foreach($newTree as $n) {
            if(in_array($n['id'], $newIDs)) {
                // insert
                $sql = "INSERT INTO folderTree (subject_id, label, embed_code, resource_type, hierarchy_level, parent_folder_id, display_order) VALUES ({$subjectID}, '{$n['label']}', '{$n['embed_code']}', '{$n['resource_type']}', {$n['hierarchy_level']}, {$n['parent_folder_id']}, {$n['display_order']})";
                
                echo $sql; die();
                
                $query = mysqli_query($this->dbCon, $sql);
            }
           
            if(in_array($n['id'], $this->subjectIDs[$subjectID])) {
                // delete
                    
            } 
        }
        
        // Disable 'deleted' items
        /*
$toDelete = implode(", ", $this->subjectIDs[$subjectID]);
        $sql_disable = "UPDATE FolderTree SET is_active = 0 WHERE id = ?";
        $query = $this->db->query($sql_disable, array($toDelete));
        // Finish current Edit
        $sql_edit = "UPDATE FolderTreeEdits SET is_being_edited = 0 WHERE useraccount_id = ? AND subject_id = ? AND school_id = ? AND is_being_edited = 1";
        $this->db->query($sql_edit, array($this->session->userdata('useraccount_id'), $subjectID, $schoolID));
*/
       
    }
    
    public function saveSessionToDB() { 
	   $sessionID = session_id();
	   $sql = "INSERT INTO sessions (session_id) VALUES ('{$sessionID}')";
	   $query = mysqli_query($this->dbCon, $sql);  
    }
    
    public function saveVideoWatch($schoolID, $subjectID, $videoID) {
	    $sessionID = session_id();
	    $sql = "SELECT id FROM sessions WHERE session_id = '{$sessionID}'";
	    $query = mysqli_query($this->dbCon, $sql);
	    
	    $sessionLogID = mysqli_fetch_array($query);
	    
	    $sql = "INSERT INTO video_tracking (session_log_id, video_id, subject_id, school_id) VALUES ({$sessionLogID['id']}, {$videoID}, {$subjectID}, {$schoolID})";
	    $query = mysqli_query($this->dbCon, $sql); 
    }
    public function getSchools() { 
       $sql = "SELECT id, name FROM schools ORDER BY name ASC;";
       return $query = mysqli_query($this->dbCon, $sql); 
    }
}

?>
