<?php 
/**
 * Plugin Name: Post Suggestions
 * Plugin URI: http://niteco.se
 * Description: Förslag på personer
 * Version: 0.0.4
 * Author: Tuan Anh
 * Author URI: htpp://niteco.se
 */

require_once ('suggestions-page/Constants/Constants.php');
 if( !class_exists('Suggestion_Page_Plugin' )) {

    class Suggestion_Page_Plugin {

        function __construct() {
            
            //create menu
            add_action( 'admin_menu', array( $this, 'menu_suggestion_page') );  

            //create setting page
            add_action( 'admin_menu', array( $this, 'menu_suggestion_page_setting_page' ) );
            add_action( 'admin_init', array( $this, 'page_init' ) );
        }


        //Suggestion page
        function menu_suggestion_page() {
            add_menu_page( 'Förslag på personer', 'Förslag', 'manage_options', 'suggestions', array( $this, 'create_suggestion_page'), 'dashicons-format-status', 6);
        }

        function create_suggestion_page() {
          require_once (plugin_dir_path( __FILE__ ).'suggestions-page/index.php');
        }


        //Suggestion plugin setting
        public function menu_suggestion_page_setting_page()
        {
            // This page will be under "Settings"
            add_options_page(
                'Settings Admin', 
                'Förslag', 
                'manage_options', 
                'suggestion-setting', 
                array( $this, 'create_menu_suggestion_page_setting_page' )
            );
        }
    
        /**
         * Options page callback
         */
        public function create_menu_suggestion_page_setting_page()
        {
            // Set class property
            $this->options = get_option( 'suggestion-option' );
            ?>
            <style>
                .column-setting-label {
                    margin-left:20px;
                }
                .column-setting-content {
                    margin-left:5px;
                }
            </style>
            <div class="wrap">
                <h1><?php echo isset( $this->options['suggestion_page_title'] ) ? esc_attr( $this->options['suggestion_page_title']) : SUGESSTION_TITLE_PAGE_OPTION; ?> Settings</h1>
                <form method="post" action="options.php">
                <?php
                    // This prints out all hidden setting fields
                    settings_fields( 'suggestion-option-group' );
                    do_settings_sections( 'suggestion-setting' );
                    submit_button();
                ?>
                </form>
            </div>
            <?php
        }
    
        /**
         * Register and add settings
         */
        public function page_init()
        {        
            register_setting(
                'suggestion-option-group', // Option group
                'suggestion-option', // Option name
                array( $this, 'sanitize' ) // Sanitize
            );


            //Setting Common
            add_settings_section(
                'setting_section_common', 
                'Common',
                array( $this, 'print_section_info' ), 
                'suggestion-setting' 
            );  

            add_settings_field(
                'suggestion_page_title', 
                'Page Title',
                array( $this, 'page_title_callback' ), 
                'suggestion-setting',
                'setting_section_common'
            );
            
            //Setting Query
            add_settings_section(
                'setting_section_query', 
                'Query',
                array( $this, 'print_setting_query_section_info' ), 
                'suggestion-setting' 
            );

            add_settings_field(
                'suggestion_database_query_from', 
                'DB query FROM', 
                array( $this, 'database_query_from_callback' ), 
                'suggestion-setting', 
                'setting_section_query'
            );  

            add_settings_field(
                'suggestion_limit_request', 
                'Page size', 
                array( $this, 'limit_request_callback' ), 
                'suggestion-setting', 
                'setting_section_query'      
            );    

            add_settings_field(
                'suggestion_query_default_id', 
                'DB ID field', 
                array( $this, 'query_default_id_callback' ), 
                'suggestion-setting', 
                'setting_section_query'      
            ); 

            add_settings_field(
                'suggestion_query_default_status', 
                'DB Post Status field', 
                array( $this, 'query_default_status_callback' ), 
                'suggestion-setting', 
                'setting_section_query'      
            ); 

            add_settings_field(
                'suggestion_database_query_orderby_default', 
                'DB default order field', 
                array( $this, 'database_query_select_orderby_default_callback' ), 
                'suggestion-setting', 
                'setting_section_query'
            ); 

            //Setting Column 1
			add_settings_section(
				'setting_section_column',
				'Columns Settings',
				array( $this, 'print_setting_column_section_info' ),
				'suggestion-setting'
			);

            add_settings_field(
                'suggestion_title_column_1', 
                'Column 1: ', 
                array( $this, 'title_column_1_callback' ), 
                'suggestion-setting', 
                'setting_section_column'      
            ); 

            add_settings_field(
                'suggestion_title_column_2', 
                'Column 2: ', 
                array( $this, 'title_column_2_callback' ), 
                'suggestion-setting', 
                'setting_section_column'      
            ); 

            add_settings_field(
                'suggestion_title_column_3', 
                'Column 3: ', 
                array( $this, 'title_column_3_callback' ), 
                'suggestion-setting', 
                'setting_section_column'      
            ); 

            add_settings_field(
                'suggestion_title_column_4', 
                'Column 4: ', 
                array( $this, 'title_column_4_callback' ), 
                'suggestion-setting', 
                'setting_section_column'      
            ); 

            add_settings_field(
                'suggestion_title_column_5', 
                'Column 5: ', 
                array( $this, 'title_column_5_callback' ), 
                'suggestion-setting', 
                'setting_section_column'      
            ); 

        }
    
        /**
         * Sanitize each setting field as needed
         *
         * @param array $input Contains all settings fields as array keys
         */
        public function sanitize( $input )
        {
            $new_input = array();

            //Default
            if( isset( $input['suggestion_page_title'] ) )
            $new_input['suggestion_page_title'] = sanitize_text_field( $input['suggestion_page_title'] );

            if( isset( $input['suggestion_database_query_from'] ) )
            $new_input['suggestion_database_query_from'] = sanitize_text_field( $input['suggestion_database_query_from'] );

            if( isset( $input['suggestion_limit_request'] ) )
            $new_input['suggestion_limit_request'] = absint( $input['suggestion_limit_request'] );

            if( isset( $input['suggestion_query_default_id'] ) )
            $new_input['suggestion_query_default_id'] = sanitize_text_field( $input['suggestion_query_default_id'] );

            if( isset( $input['suggestion_query_default_status'] ) )
            $new_input['suggestion_query_default_status'] = sanitize_text_field( $input['suggestion_query_default_status'] );

            if( isset( $input['suggestion_database_query_orderby_default'] ) )
            $new_input['suggestion_database_query_orderby_default'] = sanitize_text_field( $input['suggestion_database_query_orderby_default'] );

            //Column 1            
            if( isset( $input['suggestion_title_column_1'] ) )
            $new_input['suggestion_title_column_1'] = sanitize_text_field( $input['suggestion_title_column_1'] );

            if( isset( $input['suggestion_database_query_column_1'] ) )
            $new_input['suggestion_database_query_column_1'] = sanitize_text_field( $input['suggestion_database_query_column_1'] );

            $new_input['checkbox_suggestion_sort_column_1'] = isset( $input['checkbox_suggestion_sort_column_1'] ) ? absint( $input['checkbox_suggestion_sort_column_1'] ) : 0;
            $new_input['checkbox_suggestion_search_column_1'] = isset( $input['checkbox_suggestion_search_column_1'] ) ? absint( $input['checkbox_suggestion_search_column_1'] ) : 0;
            
            //Column 2            
            if( isset( $input['suggestion_title_column_2'] ) )
            $new_input['suggestion_title_column_2'] = sanitize_text_field( $input['suggestion_title_column_2'] );

            if( isset( $input['suggestion_database_query_column_2'] ) )
            $new_input['suggestion_database_query_column_2'] = sanitize_text_field( $input['suggestion_database_query_column_2'] );

            $new_input['checkbox_suggestion_sort_column_2'] = isset( $input['checkbox_suggestion_sort_column_2'] ) ? absint( $input['checkbox_suggestion_sort_column_2'] ) : 0;
            $new_input['checkbox_suggestion_search_column_2'] = isset( $input['checkbox_suggestion_search_column_2'] ) ? absint( $input['checkbox_suggestion_search_column_2'] ) : 0;

            //Column 3
            if( isset( $input['suggestion_title_column_3'] ) )
            $new_input['suggestion_title_column_3'] = sanitize_text_field( $input['suggestion_title_column_3'] );

            if( isset( $input['suggestion_database_query_column_3'] ) )
            $new_input['suggestion_database_query_column_3'] = sanitize_text_field( $input['suggestion_database_query_column_3'] );

            $new_input['checkbox_suggestion_sort_column_3'] = isset( $input['checkbox_suggestion_sort_column_3'] ) ? absint( $input['checkbox_suggestion_sort_column_3'] ) : 0;
            $new_input['checkbox_suggestion_search_column_3'] = isset( $input['checkbox_suggestion_search_column_3'] ) ? absint( $input['checkbox_suggestion_search_column_3'] ) : 0;

            //Column 4            
            if( isset( $input['suggestion_title_column_4'] ) )
            $new_input['suggestion_title_column_4'] = sanitize_text_field( $input['suggestion_title_column_4'] );

            if( isset( $input['suggestion_database_query_column_4'] ) )
            $new_input['suggestion_database_query_column_4'] = sanitize_text_field( $input['suggestion_database_query_column_4'] );
            
            $new_input['checkbox_suggestion_sort_column_4'] = isset( $input['checkbox_suggestion_sort_column_4'] ) ? absint( $input['checkbox_suggestion_sort_column_4'] ) : 0;
            $new_input['checkbox_suggestion_search_column_4'] = isset( $input['checkbox_suggestion_search_column_4'] ) ? absint( $input['checkbox_suggestion_search_column_4'] ) : 0;

            //Column 5            
            if( isset( $input['suggestion_title_column_5'] ) )
            $new_input['suggestion_title_column_5'] = sanitize_text_field( $input['suggestion_title_column_5'] );

            if( isset( $input['suggestion_database_query_column_5'] ) )
            $new_input['suggestion_database_query_column_5'] = sanitize_text_field( $input['suggestion_database_query_column_5'] );

            $new_input['checkbox_suggestion_sort_column_5'] = isset( $input['checkbox_suggestion_sort_column_5'] ) ? absint( $input['checkbox_suggestion_sort_column_5'] ) : 0;
            $new_input['checkbox_suggestion_search_column_5'] = isset( $input['checkbox_suggestion_search_column_5'] ) ? absint( $input['checkbox_suggestion_search_column_5'] ) : 0;

            return $new_input;

        }
    
        /** 
         * Print the Section text
         */


        public function print_section_info() {
            print 'Enter your settings below:';
        }

        public function print_setting_query_section_info() {
            print 'Settings for database query:';
        }

        public function print_setting_column_section_info() {
            print 'Settings for columns:';
        }

        /** 
         * Get the settings option array and print one of its values
         */

        //Function call back DEFAULT
        public function page_title_callback() {
            printf(
                '<input type="text" id="suggestion_page_title" name="suggestion-option[suggestion_page_title]" value="%s"/>',
                isset( $this->options['suggestion_page_title'] ) ? esc_attr( $this->options['suggestion_page_title']) : SUGESSTION_TITLE_PAGE_OPTION
            );
        }


        public function database_query_from_callback() {
            printf(
                '<input type="text" id="suggestion_database_query_from" name="suggestion-option[suggestion_database_query_from]" value="%s" size="105" />',
                isset( $this->options['suggestion_database_query_from'] ) ? esc_attr( $this->options['suggestion_database_query_from']) : SUGESSTION_Q_QUERY_FROM_OPTION
            );
        }

        public function limit_request_callback() {
            printf(
                '<input type="text" id="suggestion_limit_request" name="suggestion-option[suggestion_limit_request]" value="%s" />',
                isset( $this->options['suggestion_limit_request'] ) ? esc_attr( $this->options['suggestion_limit_request']) : SUGESSTION_PAGE_SIZE_OPTION
            );
        }

        public function query_default_id_callback() {
            printf(
                '<input type="text" id="suggestion_query_default_id" name="suggestion-option[suggestion_query_default_id]" value="%s"/>',
                isset( $this->options['suggestion_query_default_id'] ) ? esc_attr( $this->options['suggestion_query_default_id']) : SUGESSTION_Q_ID_OPTION
            );
        }

        public function query_default_status_callback() {
            printf(
                '<input type="text" id="suggestion_query_default_status" name="suggestion-option[suggestion_query_default_status]" value="%s"/>',
                isset( $this->options['suggestion_query_default_status'] ) ? esc_attr( $this->options['suggestion_query_default_status']) : SUGESSTION_Q_POSTSTATUS_OPTION
            );
        }

        public function database_query_select_orderby_default_callback() {
            printf(
                '<input type="text" id="suggestion_database_query_orderby_default" name="suggestion-option[suggestion_database_query_orderby_default]" value="%s"/>',
                isset( $this->options['suggestion_database_query_orderby_default'] ) ? esc_attr( $this->options['suggestion_database_query_orderby_default']) : SUGESSTION_Q_DEFAULT_ORDERBY_OPTION
            );
        }
        //Function callback COLUMN 1        
        public function title_column_1_callback() {
            echo '<label for="suggestion_title_column_1">Title: </label>';                                                            
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_title_column_1" name="suggestion-option[suggestion_title_column_1]" value="%s" />',
                isset( $this->options['suggestion_title_column_1'] ) ? esc_attr( $this->options['suggestion_title_column_1']) : SUGESSTION_COL1_HEADER_OPTION
            );

            echo '<label class="column-setting-label" for="suggestion_database_query_column_1">DB field: </label>';    
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_database_query_column_1" name="suggestion-option[suggestion_database_query_column_1]" value="%s"/>',
                isset( $this->options['suggestion_database_query_column_1'] ) ? esc_attr( $this->options['suggestion_database_query_column_1']) : SUGESSTION_Q_COL1_OPTION
            );

            echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_sort_column_1]" ' . checked( isset( $this->options['checkbox_suggestion_sort_column_1']) ? $this->options['checkbox_suggestion_sort_column_1'] : SUGESSTION_Q_COL1_SORTABLE_OPTION, 1, false ) . ' value="1">';
			echo '<label class="column-setting-content" for="checkbox_suggestion_sort_column_1">Sortable</label>';
            
                  
            echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_search_column_1]" ' . checked( isset($this->options['checkbox_suggestion_search_column_1']) ? $this->options['checkbox_suggestion_search_column_1'] : SUGESSTION_Q_COL1_SEACHABLE_OPTION, 1, false ) . ' value="1">';
            echo '<label class="column-setting-content" for="checkbox_suggestion_search_column_1">Searchable</label>';
            
        } 

        //Function callback COLUMN 2
        public function title_column_2_callback() {
            echo '<label for="suggestion_title_column_2">Title: </label>';                                                
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_title_column_2" name="suggestion-option[suggestion_title_column_2]" value="%s" />',
                isset( $this->options['suggestion_title_column_2'] ) ? esc_attr( $this->options['suggestion_title_column_2']) : SUGESSTION_COL2_HEADER_OPTION
            );

            echo '<label class="column-setting-label" for="suggestion_database_query_column_2">DB field: </label>';           
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_database_query_column_2" name="suggestion-option[suggestion_database_query_column_2]" value="%s"/>',
                isset( $this->options['suggestion_database_query_column_2'] ) ? esc_attr( $this->options['suggestion_database_query_column_2']) : SUGESSTION_Q_COL2_OPTION
            );

            echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_sort_column_2]" ' . checked( isset($this->options['checkbox_suggestion_sort_column_2']) ? $this->options['checkbox_suggestion_sort_column_2'] : SUGESSTION_Q_COL2_SORTABLE_OPTION, 1, false ) . ' value="1">';
            echo '<label class="column-setting-content" for="checkbox_suggestion_sort_column_2">Sortable</label>';   
            
            echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_search_column_2]" ' . checked( isset($this->options['checkbox_suggestion_search_column_2']) ? $this->options['checkbox_suggestion_search_column_2'] : SUGESSTION_Q_COL2_SEACHABLE_OPTION, 1, false ) . ' value="1">';
			echo '<label class="column-setting-content" for="checkbox_suggestion_search_column_2">Searchable</label>';  

        } 

        //Function callback COLUMN 3
        public function title_column_3_callback() {
            echo '<label for="suggestion_title_column_3">Title: </label>';                                    
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_title_column_3" name="suggestion-option[suggestion_title_column_3]" value="%s" />',
                isset( $this->options['suggestion_title_column_3'] ) ? esc_attr( $this->options['suggestion_title_column_3']) : SUGESSTION_COL3_HEADER_OPTION
            );

            echo '<label class="column-setting-label" for="suggestion_database_query_column_3">DB field: </label>';  
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_database_query_column_3" name="suggestion-option[suggestion_database_query_column_3]" value="%s"/>',
                isset( $this->options['suggestion_database_query_column_3'] ) ? esc_attr( $this->options['suggestion_database_query_column_3']) : SUGESSTION_Q_COL3_OPTION
            );

			echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_sort_column_3]" ' . checked( isset($this->options['checkbox_suggestion_sort_column_3']) ? $this->options['checkbox_suggestion_sort_column_3'] : SUGESSTION_Q_COL3_SORTABLE_OPTION, 1, false ) . ' value="1">';
            echo '<label class="column-setting-content" for="checkbox_suggestion_sort_column_3">Sortable</label>';   
            
			echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_search_column_3]" ' . checked( isset($this->options['checkbox_suggestion_search_column_3']) ? $this->options['checkbox_suggestion_search_column_3'] : SUGESSTION_Q_COL3_SEACHABLE_OPTION, 1, false ) . ' value="1">';
			echo '<label class="column-setting-content" for="checkbox_suggestion_search_column_3">Searchable</label>';  
        } 

        //Function callback COLUMN 4    
        public function title_column_4_callback() {
            echo '<label for="suggestion_title_column_4">Title: </label>';                        
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_title_column_4" name="suggestion-option[suggestion_title_column_4]" value="%s" />',
                isset( $this->options['suggestion_title_column_4'] ) ? esc_attr( $this->options['suggestion_title_column_4']) : SUGESSTION_COL4_HEADER_OPTION
            );

            echo '<label class="column-setting-label" for="suggestion_database_query_column_4">DB field: </label>';   
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_database_query_column_4" name="suggestion-option[suggestion_database_query_column_4]" value="%s"/>',
                isset( $this->options['suggestion_database_query_column_4'] ) ? esc_attr( $this->options['suggestion_database_query_column_4']) : SUGESSTION_Q_COL4_OPTION
            );

            echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_sort_column_4]" ' . checked( isset($this->options['checkbox_suggestion_sort_column_4']) ? $this->options['checkbox_suggestion_sort_column_4'] : SUGESSTION_Q_COL4_SORTABLE_OPTION, 1, false ) . ' value="1">';
            echo '<label class="column-setting-content" for="checkbox_suggestion_sort_column_4">Sortable</label>'; 

            echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_search_column_4]" ' . checked( isset($this->options['checkbox_suggestion_search_column_4']) ? $this->options['checkbox_suggestion_search_column_4'] : SUGESSTION_Q_COL4_SEACHABLE_OPTION, 1, false ) . ' value="1">';
			echo '<label class="column-setting-content" for="checkbox_suggestion_search_column_4">Searchable</label>'; 

        } 

        //Function callback COLUMN 5    
        public function title_column_5_callback() {
            echo '<label for="suggestion_title_column_5">Title: </label>';            
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_title_column_5" name="suggestion-option[suggestion_title_column_5]" value="%s"/>',
                isset( $this->options['suggestion_title_column_5'] ) ? esc_attr( $this->options['suggestion_title_column_5']) : SUGESSTION_COL5_HEADER_OPTION
            );

            echo '<label class="column-setting-label" for="suggestion_database_query_column_5">DB field: </label>';    
            printf(
                '<input class="column-setting-content" type="text" id="suggestion_database_query_column_5" name="suggestion-option[suggestion_database_query_column_5]" value="%s"/>',
                isset( $this->options['suggestion_database_query_column_5'] ) ? esc_attr( $this->options['suggestion_database_query_column_5']) : SUGESSTION_Q_COL5_OPTION
            );

			echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_sort_column_5]" ' . checked( isset($this->options['checkbox_suggestion_sort_column_5']) ? $this->options['checkbox_suggestion_sort_column_5'] : SUGESSTION_Q_COL5_SORTABLE_OPTION, 1, false ) . ' value="1">';
            echo '<label class="column-setting-content" for="checkbox_suggestion_sort_column_5">Sortable</label>';
            
			echo '<input style="margin-left:20px;" type="checkbox" name="suggestion-option[checkbox_suggestion_search_column_5]" ' . checked( isset($this->options['checkbox_suggestion_search_column_5']) ? $this->options['checkbox_suggestion_search_column_5'] : SUGESSTION_Q_COL5_SEACHABLE_OPTION, 1, false ) . ' value="1">';
			echo '<label class="column-setting-content" for="checkbox_suggestion_search_column_5">Searchable</label>';        
        } 

    }
}

new Suggestion_Page_Plugin();
?>
