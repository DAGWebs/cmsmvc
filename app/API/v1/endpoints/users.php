<?php
$api = new Router();

$api->get('/list', function () {
   echo "hello users";
});

$api->get("/", function () {
   echo " from /";
});

$api->delete("/", function () {
   echo " / is set to delete";
});

$api->put("/", function () {
    echo " / is set to put";
 });

 $api->get("/user", function() {
    


 });