<?php 
    require_once(plugin_dir_path(__DIR__).'Constants/Constants.php');
    require_once(plugin_dir_path(__DIR__).'Constants/OptionConstants.php');    
    require_once(plugin_dir_path(__DIR__).'Controller/JsActionSuggestion.php');
?>
<link rel="stylesheet" href="<?php echo plugins_url();?>/wp-suggestions-page/suggestions-page/Templates/styles.css?ver=1.0.2.<?php echo date('Y-m-d'); ?>" type="text/css" media="all" />
<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo SUGESSTION_TITLE_PAGE?></h1>

	<p class="search-box">
	  <input id="textName" type="text">
	  <button id="suggestions_button_find" class="button" onClick="finds('<?php echo admin_url(); ?>')"><?php echo SUGESSTION_SEARCH_ASIKT?></button>
	  <button id="suggestions_button_clear" class="button" onClick="clears('<?php echo admin_url(); ?>')"><?php echo SUGESSTION_CLEAR?></button>
	</p>
	</p> 
    <table class="wp-list-table widefat fixed striped pages">
      <thead>
        <tr>
        <?php
          function showTableHeader(&$tableHeader, $colOrderBy, $orderby, $order, $pageNumber, $name, $titel, $style) {
          if ($orderby == $colOrderBy) {
            switch ($order) {
              case SUGESSTION_ASC:
                $tableHeader = $tableHeader . '<td class="'.$style.'" scope="col" onclick=\'sort("' .admin_url(). '","' .$pageNumber. '","' .$name. '","' .$colOrderBy. '","' .SUGESSTION_DESC. '")\'><a><span>'.$titel.'</span><span class="sorting-indicator-asc"></span></a></td>';
                break;
              case SUGESSTION_DESC:
                $tableHeader = $tableHeader . '<td class="'.$style.'" scope="col" onclick=\'sort("' .admin_url(). '","' .$pageNumber. '","' .$name. '","' .$colOrderBy. '","' .SUGESSTION_ASC. '")\'><a><span>'.$titel.'</span><span class="sorting-indicator-desc"></span></a></td>';
                break;
              default:
                $tableHeader = $tableHeader . '<td class="'.$style.'" scope="col" onclick=\'sort("' .admin_url(). '","' .$pageNumber. '","' .$name. '","' .$colOrderBy. '","' .SUGESSTION_ASC. '")\'><a><span>'.$titel.'</span></a></td>';
              }
          } else {
            $tableHeader = $tableHeader . '<td class="'.$style.'" scope="col" onclick=\'sort("' .admin_url(). '","' .$pageNumber. '","' .$name. '","' .$colOrderBy. '","' .SUGESSTION_ASC. '")\'><a><span>'.$titel.'</span></a></td>';   
            }
          }

          $tableHeader = '';
          if (SUGESSTION_CHECKBOX_SORT_COL1 == 1) {
            showTableHeader($tableHeader, SUGESSTION_Q_POST_ORDERBY_COLUMN_1, $orderby, $order, $pageNumber, $name, SUGESSTION_COL1_HEADER, "title-header-titel");  
          } else {
  		      $tableHeader = $tableHeader . '<td>'.SUGESSTION_COL1_HEADER.'</td>';
          }

          if (SUGESSTION_CHECKBOX_SORT_COL2 == 1) {
            showTableHeader($tableHeader, SUGESSTION_Q_POST_ORDERBY_COLUMN_2, $orderby, $order, $pageNumber, $name, SUGESSTION_COL2_HEADER, "title-header-mid");     
          } else {
  		      $tableHeader = $tableHeader . '<td>'.SUGESSTION_COL2_HEADER.'</td>';
          }

          if (SUGESSTION_CHECKBOX_SORT_COL3 == 1) {
            showTableHeader($tableHeader, SUGESSTION_Q_POST_ORDERBY_COLUMN_3, $orderby, $order, $pageNumber, $name, SUGESSTION_COL3_HEADER, "title-header-mid");     
          } else {
  		      $tableHeader = $tableHeader . '<td>'.SUGESSTION_COL3_HEADER.'</td>';
          }

          if (SUGESSTION_CHECKBOX_SORT_COL4 == 1) {
            showTableHeader($tableHeader, SUGESSTION_Q_POST_ORDERBY_COLUMN_4, $orderby, $order, $pageNumber, $name, SUGESSTION_COL4_HEADER, "title-header-mid");     
          } else {
		      $tableHeader = $tableHeader . '<td>'.SUGESSTION_COL4_HEADER.'</td>';            
          }
          if (SUGESSTION_CHECKBOX_SORT_COL5 == 1) {
            showTableHeader($tableHeader, SUGESSTION_Q_POST_ORDERBY_COLUMN_5, $orderby, $order, $pageNumber, $name, SUGESSTION_COL5_HEADER, "title-header-mid");     
          } else {
		      $tableHeader = $tableHeader . '<td>'.SUGESSTION_COL5_HEADER.'</td>';                    
          }
          
		      echo $tableHeader;
          ?>
        </tr>
      </thead>
      <tbody>

        <?php
          if(count($data) > 0) {
            foreach($data as $item) {
              echo '<tr>';
              if (SUGESSTION_QUERY_DEFAULT_STATUS == "") {
                echo '<td>'.$item->{$itemColumn1}.'</td>';                
              } else {
                switch($item->post_status) {
                  case "trash":
                    echo '<td>'.$item->{$itemColumn1}.'</td>';                
                    break;
                  case "publish":
                    echo '<td><a class="row-title" href="'.admin_url().'/post.php?post='.$item->ID.'&action=edit"><span class="status-pub" >Pub</span>'.$item->{$itemColumn1}.'</a></td>';                
                    break;
                  case "draft":
                    echo '<td><a class="row-title" href="'.admin_url().'/post.php?post='.$item->ID.'&action=edit"><span class="status-draft" >Utkast</span>'.$item->{$itemColumn1}.'</p></a></td>';                   
                    break;
                  default:
                    echo '<td><a class="row-title" href="'.admin_url().'/post.php?post='.$item->ID.'&action=edit">'.$item->{$itemColumn1}.'</a></td>';
                }
              }
              echo '<td id="suggestions_display_name" class="suggestions_row">' . ($item->{$itemColumn2} == null ? '—' : $item->{$itemColumn2}) . '</td>';
			        echo '<td id="suggestions_name" class="suggestions_row">' . ($item->{$itemColumn3} == null ? '—' : $item->{$itemColumn3}) . '</td>';
			        echo '<td id="suggestions_contact" class="suggestions_row">' . ($item->{$itemColumn4} == null ? '—' : $item->{$itemColumn4}) . '</td>';
              echo '<td id="suggestions_email" class="suggestions_row">' . ($item->{$itemColumn5} == null ? '—' : $item->{$itemColumn5}) . '</td>';
              echo '</tr>';
            }
          } else {
            echo '<tr>';
            echo '<td><p>Not found</p></td>';
            echo '<td></td>';
            echo '<td></td>'; 
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
            ?>
            <?php
          }
        ?>
      </tbody>
	  <tfoot>
		<tr>
          <?php
			echo $tableHeader;
          ?>
		</tr>
	  </tfoot>
    </table>
          
  <?php
    if(sizeof($data) > 0) {
      ?>
<div class="tablenav">
  <div class="tablenav-pages"><span class="displaying-num"><?php echo $totalItems?> items</span>
    <span class="pagination-links">

        <?php
          $links = SUGESSTION_DISPLAY_PAGE_MID;
          $start = ($pageNumber - $links) > SUGESSTION_DISPLAY_PAGE_START ? $pageNumber - $links : SUGESSTION_DISPLAY_PAGE_START;
          $end =   ($pageNumber + $links) < $totalPages ? $pageNumber + $links : $totalPages;
		      $displayStart = SUGESSTION_DISPLAY_PAGE_START;
          $displayEnd = SUGESSTION_DISPLAY_PAGE_END;
		      $pageButtonHtml = '<a class="'.SUGESSTION_CSS.'" href="'.admin_url().'admin.php?page=suggestions&'.SUGESSTION_PAGE_NUMBER.'='.SUGESSTION_PAGE_INDEX.'&'.SUGESSTION_SEARCH.'='.$name.'&'.SUGESSTION_ORDERBY.'='.$orderby.'&'.SUGESSTION_ORDER.'='.$order.'"><span aria-hidden="true">'.SUGESSTION_BUTTON_TEXT.'</span></a>'. PHP_EOL;

          if(count($data) > 0) {
			      echo str_replace( SUGESSTION_BUTTON_TEXT, "«", str_replace(SUGESSTION_PAGE_INDEX, 0, str_replace(SUGESSTION_CSS, 'first-page', $pageButtonHtml) ) );
          }

          if($pageNumber == SUGESSTION_LIMIT_PAGE) {
			      $displayStart = SUGESSTION_DISPLAY_PAGE_START;
			      $displayEnd = min($totalPages, SUGESSTION_LIMIT_PAGE) - 1;
          }
		  else if($pageNumber+1 == $totalPages) {
			  $displayStart = max(SUGESSTION_DISPLAY_PAGE_START, $totalPages - SUGESSTION_LIMIT_PAGE);
			  $displayEnd = $totalPages - 1;
		  }
		  else {
            if($totalPages < SUGESSTION_LIMIT_PAGE) {
				      $displayStart = SUGESSTION_DISPLAY_PAGE_START;
				      $displayEnd = $totalPages - 1;
            } else {
              if($pageNumber < SUGESSTION_DISPLAY_PAGE_MID) {
                $displayStart = SUGESSTION_DISPLAY_PAGE_START;
				        $displayEnd = SUGESSTION_DISPLAY_PAGE_END;
              } else {
                $displayStart = $start;
				        $displayEnd = $end - 1;
              }
            }
          }

		      for($i = $displayStart; $i <= $displayEnd; $i++) {
			      echo str_replace( SUGESSTION_BUTTON_TEXT, $i+1, str_replace(SUGESSTION_PAGE_INDEX, $i, str_replace(SUGESSTION_CSS, ($pageNumber == $i ? 'button-active' : ''), $pageButtonHtml) ) );
          }

          if(count($data)> 0) {
			      echo str_replace( SUGESSTION_BUTTON_TEXT, "»", str_replace(SUGESSTION_PAGE_INDEX, ($totalPages-1), str_replace(SUGESSTION_CSS, 'last-page', $pageButtonHtml) ) );
          }
          
        ?>
    </span>
  </div>
</div>
      <?php
    }
  ?>        
  <script type="text/javascript">
    var name = "";
    var url_string = window.location.href;
    var url = new URL(url_string);
    var name_sugesstion = url.searchParams.get("<?php echo SUGESSTION_SEARCH?>");
    if (name_sugesstion !== null) {
      name = name_sugesstion;
    }

    document.getElementById("textName").value = unescape(name);
    document.getElementById("textName")
    .addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            finds('<?php echo admin_url(); ?>');
        }
    });
  </script>    
</div>