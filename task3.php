<?php
$n = filter_input(INPUT_POST,'n');
$k = filter_input(INPUT_POST,'k');

if(isset($n)&&isset($k)&&is_numeric($n)&&is_numeric($k))
{

    $s=new solution();
    echo 'Если N = '.$n.' и K = '.$k.' то позиция K будет '.$s->search_numbers($n,$k);

}
else {
    echo "<html>
<head>
    <meta content=\"unicode\">
    <title>
        Странная алгебра
    </title>
</head>
<body>
<form action=\"task3.php\" method=\"POST\">
<div><h1>Write numbers N and K</h1></div>
<table>
    <tr>
        <td>Write N</td>
        <td><input type=\"text\"name = \"n\"></td>
    </tr>
    <tr>
        <td>Write K</td>
        <td><input type=\"text\"name = \"k\"> </td>
    </tr>
    <tr>
        <td>
            <input type=\"submit\">
        </td>
    </tr>
</table>
</form>
</body>
</html>";
}
class solution
{
    function search_numbers($n,$k)
    {
        $originalK = $k;
        $rank10 = 1;
        while($rank10*10<=$k)
        {
            $rank10 *= 10;
        }
        $originalrank10 = $rank10;
        $position = 0;
        while($rank10>=1)
        {
            $position += $k - $rank10 + 1;
            $rank10 /= 10;
            $k /= 10;
        }
        $k = $originalK;
        $rank10 = $originalrank10;
        if($k!=$rank10)
        {
            while(true)
            {
                $rank10 *= 10;
                if($rank10>$n)
                {
                    break;
                }
                $k *= 10;
                if($n<$k)
                {
                    $position += $n - $rank10 + 1;
                    break;
                }
                else
                {
                    $position += $k - $rank10;
                }
            }
        }


        return (int)$position;
    }

}


