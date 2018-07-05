<?php

    //Url params
    define('SUGESSTION_PAGE_NUMBER', 'pageindex');
    define('SUGESSTION_SEARCH', 'search');
    define('SUGESSTION_ORDERBY', 'orderby');
    define('SUGESSTION_ASC', 'asc');
    define('SUGESSTION_ORDER', 'order');
    define('SUGESSTION_DESC', 'desc');

    //Templates/index.php
    define('SUGESSTION_BUTTON_TEXT', '##ButtonText##');      
    define('SUGESSTION_PAGE_INDEX', '##PageIndex##');    
    define('SUGESSTION_CSS', '##Css##'); 

    define('SUGESSTION_SEARCH_ASIKT', 'Sök åsikt'); 
    define('SUGESSTION_CLEAR', 'Clear');                                                                                              
    
    //Paging
    define('SUGESSTION_PAGE_SIZE_OPTION', 10);
    define('SUGESSTION_LIMIT_PAGE', 10);       
    define('SUGESSTION_DISPLAY_PAGE_START', 0);
    define('SUGESSTION_DISPLAY_PAGE_MID', 5);           
    define('SUGESSTION_DISPLAY_PAGE_END', 9);

    //item
    define('SUGESSTION_ITEM_POST_TITLE_OPTION', 'post_title');                                                                                                                                                                                                   
    define('SUGESSTION_ITEM_DISPLAY_NAME_OPTION', 'display_name');                                                                                                  
    define('SUGESSTION_ITEM_NAME_OPTION', 'name');                                                                                                  
    define('SUGESSTION_ITEM_CONTACT_OPTION', 'contact');                                                                                                  
    define('SUGESSTION_ITEM_MOTIVATION_OPTION', 'motivation');     
    
    
    //Query
    define('SUGESSTION_Q_QUERY_FROM_OPTION', 'FROM reply_suggestions rs JOIN wp_users u ON (rs.user_id = u.id) JOIN wp_posts p ON (rs.post_id = p.ID)');
    define('SUGESSTION_Q_DEFAULT_ORDERBY_OPTION', 'rs.ID');
    define('SUGESSTION_Q_ID_OPTION', 'p.ID');
    define('SUGESSTION_Q_POSTSTATUS_OPTION', 'p.post_status');
    define('SUGESSTION_Q_COL1_OPTION', 'p.post_title');
    define('SUGESSTION_Q_COL2_OPTION', 'u.display_name');
    define('SUGESSTION_Q_COL3_OPTION', 'rs.name');
    define('SUGESSTION_Q_COL4_OPTION', 'rs.contact');                                                                                                  
    define('SUGESSTION_Q_COL5_OPTION', 'rs.motivation');
    define('SUGESSTION_Q_COL1_SORTABLE_OPTION', 1);
    define('SUGESSTION_Q_COL2_SORTABLE_OPTION', 1);
    define('SUGESSTION_Q_COL3_SORTABLE_OPTION', 1);
    define('SUGESSTION_Q_COL4_SORTABLE_OPTION', 0);
    define('SUGESSTION_Q_COL5_SORTABLE_OPTION', 0);
    define('SUGESSTION_Q_COL1_SEACHABLE_OPTION', 1);
    define('SUGESSTION_Q_COL2_SEACHABLE_OPTION', 0);
    define('SUGESSTION_Q_COL3_SEACHABLE_OPTION', 0);
    define('SUGESSTION_Q_COL4_SEACHABLE_OPTION', 0);
    define('SUGESSTION_Q_COL5_SEACHABLE_OPTION', 1);
    
    //Title
    define('SUGESSTION_TITLE_PAGE_OPTION', 'Förslag på personer');
    define('SUGESSTION_COL1_HEADER_OPTION', 'Titel'); 
    define('SUGESSTION_COL2_HEADER_OPTION', 'Från'); 
    define('SUGESSTION_COL3_HEADER_OPTION', 'Namn'); 
    define('SUGESSTION_COL4_HEADER_OPTION', 'Kontakt'); 
    define('SUGESSTION_COL5_HEADER_OPTION', 'Motivering');
?>