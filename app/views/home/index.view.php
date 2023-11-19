<?php $this->start("body") ?>
<h1>Hello from home page</h1>
<?php $this->end() ?>


<?php
$fields = [
    'post_id' => 'INT AUTO_INCREMENT PRIMARY KEY',
    'post_name' => 'VARCHAR(255) NOT NULL',
    'post_description' => 'TEXT',
    'post_date' => 'DATETIME',
    'post_status' => 'VARCHAR(20)',
    'post_views' => 'INT',
    'post_image' => 'VARCHAR(255)',
    'post_content' => 'TEXT',
    'post_author' => 'VARCHAR(255)',
    
];
$post = new Model('posts', $fields);
var_dump($post->findByID('post_author', 1));

