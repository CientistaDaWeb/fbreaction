<!DOCTYPE html>
<html>
<head>
    <title>Maradona X Pelé</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script>
        "use strict";
        var access_token = '1511840965509126|v06elhYe8E6YjY66MtvZgjrlrWg';
        var postID = '<?php echo $_GET['post_id']; ?>';
        var refreshTime = 5;

        var reactions = ['LIKE', 'LOVE'].map(function (e) {
            var code = 'reactions_' + e.toLowerCase();
            return 'reactions.type(' + e + ').limit(0).summary(total_count).as(' + code + ')'
        }).join(',');


        function refreshCounts() {
            var url = 'https://graph.facebook.com/v2.8/?ids=' + postID + '&fields=' + reactions + '&access_token=' + access_token;
            $.getJSON(url, function(res){
                $('#reaction-like').text(0+res[postID].reactions_like.summary.total_count);
                $('#reaction-love').text(0+res[postID].reactions_love.summary.total_count);
            });
        }

        $(document).ready(function(){
            setInterval(refreshCounts, refreshTime * 1000);
            refreshCounts();
        });
    </script>
</head>
<body>
<div id="root">
    <div id="reaction-love">0</div>
    <div id="reaction-like">0</div>
</div>
</body>
</html>