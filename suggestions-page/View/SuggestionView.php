<?php
  class SuggestionView {

    public function bindingDatatView($data, $itemColumn1, $itemColumn2, $itemColumn3, $itemColumn4, $itemColumn5, $pageNumber, $totalPages, $name, $orderby, $order, $totalItems) {
      require_once(plugin_dir_path(__DIR__).'Templates/index.php');      
    }
  }
?>