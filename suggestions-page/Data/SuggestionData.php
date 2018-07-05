<?php

    require_once(plugin_dir_path(__DIR__).'Libs/Database.php');
    require_once(plugin_dir_path(__DIR__).'Constants/Constants.php');
    require_once(plugin_dir_path(__DIR__).'Constants/OptionConstants.php');

    class SuggestionData {
        private $con = null;
        private $codeSqlFrom = SUGESSTION_QUERY_FROM;
        
        public function __construct() {
            $this->con = Database::connect();
            $this->options = get_option( 'suggestion-option' );
        }

        public function getTotalSugesstionsByName($where,$name) {
            $sql = "SELECT Count(1) $this->codeSqlFrom $where";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':name',$name, PDO::PARAM_STR);      
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $counts = $stmt->fetchColumn(); 
            return $counts;
        }

        
        public function getDataSuggestionsByName($where, $name, $limit, $offset, $orderby, $order) {

            $selectColumn1 = "";
            if (SUGESSTION_Q_POST_ORDERBY_COLUMN_1 != "") {
                $selectColumn1 = ",".SUGESSTION_Q_POST_ORDERBY_COLUMN_1;
            }
            $defaultStatus = "";
            if (SUGESSTION_QUERY_DEFAULT_STATUS != "") {
                $defaultStatus = ",".SUGESSTION_QUERY_DEFAULT_STATUS;
            }
            $selectColumn2 = "";
            if (SUGESSTION_Q_POST_ORDERBY_COLUMN_2 != "") {
                $selectColumn2 = ",".SUGESSTION_Q_POST_ORDERBY_COLUMN_2;
            }
            $selectColumn3 = "";
            if (SUGESSTION_Q_POST_ORDERBY_COLUMN_3 != "") {
                $selectColumn3 = ",".SUGESSTION_Q_POST_ORDERBY_COLUMN_3;
            }
            $selectColumn4 = "";
            if (SUGESSTION_Q_POST_ORDERBY_COLUMN_4 != "") {
                $selectColumn4 = ",".SUGESSTION_Q_POST_ORDERBY_COLUMN_4;
            }
            $selectColumn5 = "";
            if (SUGESSTION_Q_POST_ORDERBY_COLUMN_5 != "") {
                $selectColumn5 = ",".SUGESSTION_Q_POST_ORDERBY_COLUMN_5;
            }                       

            $sql = "SELECT ".SUGESSTION_QUERY_DEFAULT_ID." $selectColumn1 $defaultStatus $selectColumn2 $selectColumn3 $selectColumn4 $selectColumn5 $this->codeSqlFrom $where ORDER BY $orderby $order LIMIT $limit OFFSET $offset";
            $stmt = $this->con->prepare($sql);
            if ($where != ""){
                $stmt->bindParam(':name',$name, PDO::PARAM_STR);     
            }
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $stmt = $stmt->fetchAll();
            return $stmt;
        }

        function __destruct() {
            Database::disconnect();
        }

    }
?>