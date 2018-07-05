<?php 
    require_once(plugin_dir_path(__DIR__).'Constants/Constants.php');
?>
<script type="text/javascript">

    function finds(admin_url) {
        var name = encodeURIComponent(document.getElementById('textName').value);
        location.href = admin_url + "admin.php?page=suggestions&<?php echo SUGESSTION_PAGE_NUMBER?>=0&<?php echo SUGESSTION_SEARCH?>="+name;                  
    };

    function sort(admin_url, pageNumber,name, orderby, order) {
        location.href = admin_url + "admin.php?page=suggestions&<?php echo SUGESSTION_PAGE_NUMBER?>=" + pageNumber + "&<?php echo SUGESSTION_SEARCH?>=" + name +"&<?php echo SUGESSTION_ORDERBY?>="+ orderby +"&<?php echo SUGESSTION_ORDER?>=" + order;
    };

    function clears(admin_url) {
        location.href = admin_url + "admin.php?page=suggestions";
    }

</script>


