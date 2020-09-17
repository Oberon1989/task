<?php

$t=new temp();

//Код довольно прост из sqllite загружает статьи. Я думаю это можно сделать еще проще и красивее при желании.
//Сложность в подобной задаче дя меня может оказатся если саму статью еадо где то парсить в вебе.
$result = $t->get_articles('task1.db');
$t->create_anonses($result);

class temp
{

    function create_anonses($data)
    {
        $result=[];
        $data_count=count($data);
        foreach ($data as &$d)
        {
            $article=$d['article'];
            $id=$d['id'];
            $anons = mb_strimwidth($article,0,200);
            $split_word = explode(" ",$anons);
            $word_count=count($split_word);
            $anons_str="";
            for($i=0;$i<$word_count-3;$i++)
            {
                $anons_str.=$split_word[$i]." ";
            }
            $link = $split_word[$word_count-3]." ".$split_word[$word_count-2]." ".$split_word[$word_count-1]."...";
            array_push($result,new helper($id,$anons_str,$link));
        }
        echo "<html><head><meta charset=\"utf-8\"><title></title><style type=\"text/css\">
   .block1 { 
     width: 1000px; 
    background: #fc0; 
    padding: 5px; 
    border: solid 1px black; 
    float: left; 
    position: relative; 
    top: 40px; 
    left: 500px; 
   }
  </style> 
 </head>
 <body>
		<div class = \"block1\"><table border='2'>";
        foreach ($result as &$r)
        {
            echo"<tr><td>$r->anons <a href='task1-2.php?id=$r->id'>$r->link</a> </td><tr>";
        }
        echo"</tr></table></div></body></html>";
    }
    function get_articles($filename)
    {
        if(file_exists($filename))
        {
            $db=new SQLite3($filename);
            $result = $db->query('SELECT id , article FROM articles');
            $table = array();
            while($row=$result->fetchArray(SQLITE3_ASSOC))
            {
                $table[]=$row;
            }
            $db->close();
            return $table;

        }
        else
        {
            return null;
        }
    }





}

class helper
{
    public $id;
    public $anons;
    public $link;
    public function __construct($i,$a,$l)
    {
        $this->id=$i;
        $this->anons=$a;
        $this->link=$l;
    }
}
?>

