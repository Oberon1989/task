<?php
$id = filter_input(INPUT_GET,'id');
if(isset($id)&&is_numeric($id))
{

    $a = new article();
    $data=$a->get_article('task1.db',$id);
    $a->show($data);

}
else
{
    echo 'ет данных для отображения';
}
class article
{
    function show($data)
    {

        echo "<html><head><meta charset=\"utf-8\"><title></title><style type=\"text/css\">
   block1 { 
     width: 1000px; 
    background: #fc0; 
    padding: 5px; 
    border: solid 1px black; 
    float: left; 
    position: relative; top: 40px; left: 500px; }</style> </head><body><div class = \"block1\">".$data['article']."</div></body></html>";
    }
    function get_article($filename,$id)
    {
        if(file_exists($filename))
        {
            $db=new SQLite3($filename);
            $result = $db->query("SELECT article FROM articles WHERE id = $id");
            $table = array();
            $row=$result->fetchArray(SQLITE3_ASSOC);
            
           
            $db->close();
            return $row;

        }
        else
        {
            return null;
        }
    }
}