<script src="../assets/js/sqli.js"></script>

<?php
    
    function helper($query, $code, $last_query)
    {
        $html = <<<HTML
        <span id='help'><hr />
            <p class='lead'>SQL Query so far:</p>
            <pre id='query'>$query</pre>
            <p class='lead'>PHP Code:</p>
            <pre>$code</pre> 
HTML;
        print $html;
        if ($last_query != null)
            print "<p class='lead' id='query_help'>Last Submitted Query:</p><pre>$last_query</pre>\n";
        print "</span>";        
    }

    include '../lib/db.php';
    session_start();
    $filename = "../lib/data/" . base64_encode(base64_encode(session_id())) . ".db";
    $db = file_exists($filename) ? initDB($filename) : initDB($filename);
?>
