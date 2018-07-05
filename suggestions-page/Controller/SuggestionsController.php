<?php 
  require_once(plugin_dir_path(__DIR__).'Data/SuggestionData.php');
  require_once(plugin_dir_path(__DIR__).'View/SuggestionView.php');
  require_once(plugin_dir_path(__DIR__).'Controller/InputParam.php');
  require_once(plugin_dir_path(__DIR__).'Constants/Constants.php');
  require_once(plugin_dir_path(__DIR__).'Constants/OptionConstants.php');

  class SuggestionsController {

    function __construct() {
      $this->model = new SuggestionData();
      $this->view = new SuggestionView();
      $this->inputParam = new InputParam();      
    }

    public function getDataToShowView() {
      
      $whereCode = "";

      if (SUGESSTION_Q_POST_ORDERBY_COLUMN_1 != "" && SUGESSTION_CHECKBOX_SEARCH_COL1 == 1) {
        $whereCode = SUGESSTION_Q_POST_ORDERBY_COLUMN_1." like :name ";
      }
      if (SUGESSTION_Q_POST_ORDERBY_COLUMN_2 != "" && SUGESSTION_CHECKBOX_SEARCH_COL2 == 1) {
        if ($whereCode != "") {
          $whereCode = $whereCode." OR ";
        }
		$whereCode = $whereCode.SUGESSTION_Q_POST_ORDERBY_COLUMN_2." like :name";
      }
      if (SUGESSTION_Q_POST_ORDERBY_COLUMN_3 != "" && SUGESSTION_CHECKBOX_SEARCH_COL3 == 1) {
        if ($whereCode != "") {
          $whereCode = $whereCode." OR ";
        }
		$whereCode = $whereCode.SUGESSTION_Q_POST_ORDERBY_COLUMN_3." like :name";
      }
      if (SUGESSTION_Q_POST_ORDERBY_COLUMN_4 != "" && SUGESSTION_CHECKBOX_SEARCH_COL4 == 1) {
        if ($whereCode != "") {
          $whereCode = $whereCode." OR ";
        }
		$whereCode = $whereCode.SUGESSTION_Q_POST_ORDERBY_COLUMN_4." like :name";
      }
      if (SUGESSTION_Q_POST_ORDERBY_COLUMN_5 != "" && SUGESSTION_CHECKBOX_SEARCH_COL5 == 1) {
        if ($whereCode != "") {
          $whereCode = $whereCode." OR ";
        }
		$whereCode = $whereCode.SUGESSTION_Q_POST_ORDERBY_COLUMN_5." like :name";
      }
            
      if ($whereCode != "") {
          $where = 'WHERE ('. $whereCode .')';
      }

      $itemColumn1 = SUGESSTION_Q_POST_ORDERBY_COLUMN_1;
      if (strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_1, '.') > 0) {
		$itemColumn1 = substr(SUGESSTION_Q_POST_ORDERBY_COLUMN_1, strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_1, '.') + 1, strlen(SUGESSTION_Q_POST_ORDERBY_COLUMN_1));
      }

      $itemColumn2 = SUGESSTION_Q_POST_ORDERBY_COLUMN_2;
      if (strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_2, '.') > 0) {
		$itemColumn2 = substr(SUGESSTION_Q_POST_ORDERBY_COLUMN_2, strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_2, '.') + 1, strlen(SUGESSTION_Q_POST_ORDERBY_COLUMN_2));
      }

      $itemColumn3 = SUGESSTION_Q_POST_ORDERBY_COLUMN_3;
      if (strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_3, '.') > 0) {
		$itemColumn3 = substr(SUGESSTION_Q_POST_ORDERBY_COLUMN_3, strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_3, '.') + 1, strlen(SUGESSTION_Q_POST_ORDERBY_COLUMN_3));
      }

      $itemColumn4 = SUGESSTION_Q_POST_ORDERBY_COLUMN_4;
      if (strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_4, '.') > 0) {
		$itemColumn4 = substr(SUGESSTION_Q_POST_ORDERBY_COLUMN_4, strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_4, '.') + 1, strlen(SUGESSTION_Q_POST_ORDERBY_COLUMN_4));
      }

      $itemColumn5 = SUGESSTION_Q_POST_ORDERBY_COLUMN_5;
      if (strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_5, '.') > 0) {
		$itemColumn5 = substr(SUGESSTION_Q_POST_ORDERBY_COLUMN_5, strpos( SUGESSTION_Q_POST_ORDERBY_COLUMN_5, '.') + 1, strlen(SUGESSTION_Q_POST_ORDERBY_COLUMN_5));
      }

      $data = $this->model->getDataSuggestionsByName($where ,'%'.$this->inputParam->name.'%', $this->inputParam->limit, $this->inputParam->offset, $this->inputParam->orderby, $this->inputParam->order);
      $totalItems = $this->model->getTotalSugesstionsByName($where ,'%'.$this->inputParam->name.'%');
      $totalPages =  ceil($totalItems / $this->inputParam->limit);
      $this->view->bindingDatatView($data, $itemColumn1, $itemColumn2, $itemColumn3, $itemColumn4, $itemColumn5, $this->inputParam->pageNumber, $totalPages, $this->inputParam->name, $this->inputParam->orderby, $this->inputParam->order, $totalItems);
    }

  }

?>