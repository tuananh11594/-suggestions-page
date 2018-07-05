<?php
    require_once(plugin_dir_path(__DIR__).'Constants/Constants.php');
    
    $this->options = get_option( 'suggestion-option' );

    //All
    define('SUGESSTION_TITLE_PAGE', isset( $this->options['suggestion_page_title'] ) ? esc_attr( $this->options['suggestion_page_title']) : SUGESSTION_TITLE_PAGE_OPTION);    
    define('SUGESSTION_QUERY_FROM', isset( $this->options['suggestion_database_query_from'] ) ? esc_attr( $this->options['suggestion_database_query_from']) : SUGESSTION_Q_QUERY_FROM_OPTION);    
    define('SUGESSTION_LIMIT_REQUEST', isset( $this->options['suggestion_limit_request'] ) ? esc_attr( $this->options['suggestion_limit_request']) : SUGESSTION_PAGE_SIZE_OPTION);    
    define('SUGESSTION_QUERY_ORDERBY_DEFAULT', isset( $this->options['suggestion_database_query_orderby_default'] ) ? esc_attr( $this->options['suggestion_database_query_orderby_default']) : SUGESSTION_Q_DEFAULT_ORDERBY_OPTION); 
    define('SUGESSTION_QUERY_DEFAULT_ID', isset( $this->options['suggestion_query_default_id'] ) ? esc_attr( $this->options['suggestion_query_default_id']) : SUGESSTION_Q_ID_OPTION); 
    define('SUGESSTION_QUERY_DEFAULT_STATUS', isset( $this->options['suggestion_query_default_status'] ) ? esc_attr( $this->options['suggestion_query_default_status']) : SUGESSTION_Q_POSTSTATUS_OPTION); 

    //Templates/index.php
    //COLUMN 1
    define('SUGESSTION_COL1_HEADER', isset( $this->options['suggestion_title_column_1'] ) ? esc_attr( $this->options['suggestion_title_column_1']) : SUGESSTION_COL1_HEADER_OPTION);     
    define('SUGESSTION_Q_POST_ORDERBY_COLUMN_1', isset( $this->options['suggestion_database_query_column_1'] ) ? esc_attr( $this->options['suggestion_database_query_column_1']) : SUGESSTION_Q_COL1_OPTION);                                                                                                  
    define('SUGESSTION_ITEM_COLUMN_1', isset( $this->options['suggestion_item_column_1'] ) ? esc_attr( $this->options['suggestion_item_column_1']) : SUGESSTION_ITEM_POST_TITLE_OPTION);                                                                                                      
    define('SUGESSTION_CHECKBOX_SORT_COL1', isset( $this->options['checkbox_suggestion_sort_column_1'] ) ? esc_attr( $this->options['checkbox_suggestion_sort_column_1']) : SUGESSTION_Q_COL1_SORTABLE_OPTION);                                                                                                  
    define('SUGESSTION_CHECKBOX_SEARCH_COL1', isset( $this->options['checkbox_suggestion_search_column_1'] ) ? esc_attr( $this->options['checkbox_suggestion_search_column_1']) : SUGESSTION_Q_COL1_SEACHABLE_OPTION);                                                                                                  
        
    //COLUMN 2    
    define('SUGESSTION_COL2_HEADER', isset( $this->options['suggestion_title_column_2'] ) ? esc_attr( $this->options['suggestion_title_column_2']) : SUGESSTION_COL2_HEADER_OPTION);     
    define('SUGESSTION_Q_POST_ORDERBY_COLUMN_2', isset( $this->options['suggestion_database_query_column_2'] ) ? esc_attr( $this->options['suggestion_database_query_column_2']) : SUGESSTION_Q_COL2_OPTION);                                                                                                  
    define('SUGESSTION_ITEM_COLUMN_2', isset( $this->options['suggestion_item_column_2'] ) ? esc_attr( $this->options['suggestion_item_column_2']) : SUGESSTION_ITEM_DISPLAY_NAME_OPTION);                                                                                                          
    define('SUGESSTION_CHECKBOX_SORT_COL2', isset( $this->options['checkbox_suggestion_sort_column_2'] ) ? esc_attr( $this->options['checkbox_suggestion_sort_column_2']) : SUGESSTION_Q_COL2_SORTABLE_OPTION);                                                                                                  
    define('SUGESSTION_CHECKBOX_SEARCH_COL2', isset( $this->options['checkbox_suggestion_search_column_2'] ) ? esc_attr( $this->options['checkbox_suggestion_search_column_2']) : SUGESSTION_Q_COL2_SEACHABLE_OPTION);                                                                                                  
    
    //COLUMN 3    
    define('SUGESSTION_COL3_HEADER', isset( $this->options['suggestion_title_column_3'] ) ? esc_attr( $this->options['suggestion_title_column_3']) : SUGESSTION_COL3_HEADER_OPTION);     
    define('SUGESSTION_Q_POST_ORDERBY_COLUMN_3', isset( $this->options['suggestion_database_query_column_3'] ) ? esc_attr( $this->options['suggestion_database_query_column_3']) : SUGESSTION_Q_COL3_OPTION);                                                                                                  
    define('SUGESSTION_ITEM_COLUMN_3', isset( $this->options['suggestion_item_column_3'] ) ? esc_attr( $this->options['suggestion_item_column_3']) : SUGESSTION_ITEM_NAME_OPTION);                                                                                                        
    define('SUGESSTION_CHECKBOX_SORT_COL3', isset( $this->options['checkbox_suggestion_sort_column_3'] ) ? esc_attr( $this->options['checkbox_suggestion_sort_column_3']) : SUGESSTION_Q_COL3_SORTABLE_OPTION);                                                                                                  
    define('SUGESSTION_CHECKBOX_SEARCH_COL3', isset( $this->options['checkbox_suggestion_search_column_3'] ) ? esc_attr( $this->options['checkbox_suggestion_search_column_3']) : SUGESSTION_Q_COL3_SEACHABLE_OPTION);                                                                                                  
   
    //COLUMN 4  
    define('SUGESSTION_COL4_HEADER', isset( $this->options['suggestion_title_column_4'] ) ? esc_attr( $this->options['suggestion_title_column_4']) : SUGESSTION_COL4_HEADER_OPTION);       
    define('SUGESSTION_Q_POST_ORDERBY_COLUMN_4', isset( $this->options['suggestion_database_query_column_4'] ) ? esc_attr( $this->options['suggestion_database_query_column_4']) : SUGESSTION_Q_COL4_OPTION);                                                                                                  
    define('SUGESSTION_ITEM_COLUMN_4', isset( $this->options['suggestion_item_column_4'] ) ? esc_attr( $this->options['suggestion_item_column_4']) : SUGESSTION_ITEM_CONTACT_OPTION);                                                                                                          
    define('SUGESSTION_CHECKBOX_SORT_COL4', isset( $this->options['checkbox_suggestion_sort_column_4'] ) ? esc_attr( $this->options['checkbox_suggestion_sort_column_4']) : SUGESSTION_Q_COL4_SORTABLE_OPTION);                                                                                                  
    define('SUGESSTION_CHECKBOX_SEARCH_COL4', isset( $this->options['checkbox_suggestion_search_column_4'] ) ? esc_attr( $this->options['checkbox_suggestion_search_column_4']) : SUGESSTION_Q_COL4_SEACHABLE_OPTION);                                                                                                  
  
    //COLUMN 5    
    define('SUGESSTION_COL5_HEADER', isset( $this->options['suggestion_title_column_5'] ) ? esc_attr( $this->options['suggestion_title_column_5']) : SUGESSTION_COL5_HEADER_OPTION);     
    define('SUGESSTION_Q_POST_ORDERBY_COLUMN_5', isset( $this->options['suggestion_database_query_column_5'] ) ? esc_attr( $this->options['suggestion_database_query_column_5']) : SUGESSTION_Q_COL5_OPTION);                                                                                                  
    define('SUGESSTION_ITEM_COLUMN_5', isset( $this->options['suggestion_item_column_5'] ) ? esc_attr( $this->options['suggestion_item_column_5']) : SUGESSTION_ITEM_MOTIVATION_OPTION);                                                                                                        
    define('SUGESSTION_CHECKBOX_SORT_COL5', isset( $this->options['checkbox_suggestion_sort_column_5'] ) ? esc_attr( $this->options['checkbox_suggestion_sort_column_5']) : SUGESSTION_Q_COL5_SORTABLE_OPTION);                                                                                                  
    define('SUGESSTION_CHECKBOX_SEARCH_COL5', isset( $this->options['checkbox_suggestion_search_column_5'] ) ? esc_attr( $this->options['checkbox_suggestion_search_column_5']) : SUGESSTION_Q_COL5_SEACHABLE_OPTION);                                                                                                  

?>