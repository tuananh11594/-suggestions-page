
<?php 
    require_once(plugin_dir_path(__DIR__).'Constants/Constants.php');
    require_once(plugin_dir_path(__DIR__).'Constants/OptionConstants.php');
    
    class InputParam {
        public $pageNumber = SUGESSTION_DISPLAY_PAGE_START;
        public $name = "";        
        public $orderby = SUGESSTION_QUERY_ORDERBY_DEFAULT;
        public $order = SUGESSTION_DESC;
        public $offset = 0;
        public $limit = SUGESSTION_LIMIT_REQUEST;

        function __construct() {
         $this->getParam();
        }
        public function getParam() {
            if (isset($_GET[SUGESSTION_PAGE_NUMBER])) {
                $this->pageNumber = intval($_GET[SUGESSTION_PAGE_NUMBER]);
                $this->offset = $this->pageNumber * $this->limit;
            }
      
            if (isset($_GET[SUGESSTION_SEARCH])) {
                $this->name = urldecode($_GET[SUGESSTION_SEARCH]);
            }
      
            if (isset($_GET[SUGESSTION_ORDERBY]) && isset($_GET[SUGESSTION_ORDER])) {
                $this->orderby = $_GET[SUGESSTION_ORDERBY];   
                if ($_GET[SUGESSTION_ORDER] == SUGESSTION_ASC) {
                  $this->order= SUGESSTION_ASC;          
                } 
                if ($_GET[SUGESSTION_ORDER] == SUGESSTION_DESC) {
                  $this->order= SUGESSTION_DESC;                    
                }
            }
        }
    }
?>