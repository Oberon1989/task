<?php
//моя попытка выполнить поиск в ширину bfs
//возможно он работает не совсем правильно
$m = filter_input(INPUT_POST,'M');
$n = filter_input(INPUT_POST,'N');
if(isset($m)&&(int)$m>0&&isset($n)&&(int)$n>0)
{
    $calc = new Calculating();
    echo $calc->fix_errors_and_warnings($m,$n);
}
else
{
    echo"<html>
<head>
    <meta content=\"unicode\">
    <title>
        Помочь программисту Пете победить эрроры и ворнинги
    </title>
</head>
<body>
<form action=\"task2.php\" method=\"POST\">
<table>
    <tr>
        <td>Errors</td>
        <td><input type=\"text\"name = \"M\"></td>
    </tr>
    <tr>
        <td>Warnings</td>
        <td><input type=\"text\"name = \"N\"> </td>
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
class Calculating
{


    function fix_errors_and_warnings($m, $n)
    {

        $distance = array(array());

        for ($i = 0; $i < $m + 10; $i++) {
            for ($j = 0; $j < $n + 10; $j++) {
                $distance[$i][$j] = -1;
            }
        }

        $queue = new Queue();
        $distance[0][0] = 0;
        $queue->enqueue(new Vector2(0, 0));
        while ($queue->count() > 0) {

            $tmp = $queue->bottom();
            $i = $tmp->X;
            $j = $tmp->Y;


            $queue->dequeue();
            if ($i == $n && $j == $m) {
                return $distance[$i][$j];
            }
            if ($i <= $n + 2) {
                if (isset($distance[$i + 2][$j])) {
                    if ($distance[$i + 2][$j] == -1) {
                        $distance[$i + 2][$j] = $distance[$i][$j] + 1;
                        $queue->enqueue(new Vector2($i + 2, $j));
                    } else {
                        $distance[$i + 2][$j] = min($distance[$i + 2][$j], $distance[$i][$j] + 1);
                    }
                } else {
                    return -1;
                }
            }
            if ($i >= 1 && $j <= $n + 2) {
                if (isset($distance[$i - 1][$j + 2])) {


                    if ($distance[$i - 1][$j + 2] == -1) {
                        $distance[$i - 1][$j + 2] = $distance[$i][$j] + 1;
                        $queue->enqueue(new Vector2($i - 1, $j + 2));
                    } else {
                        $distance[$i - 1][$j + 2] = min($distance[$i - 1][$j + 2], $distance[$i][$j] + 1);
                    }
                } else {
                    return -1;
                }
            }
            if ($j > 1) {
                if (isset($distance[$i][$j - 1])) {


                    if ($distance[$i][$j - 1] == -1) {
                        $distance[$i][$j - 1] = $distance[$i][$j] + 1;
                        $queue->enqueue(new Vector2($i, $j - 1));
                    } else {
                        $distance[$i][$j - 1] = min($distance[$i][$j - 1], $distance[$i][$j] + 1);
                    }
                } else {
                    return -1;
                }
            }


        }
        return -1;

    }
}

class Vector2
{
    public $X, $Y;

    function __construct($x, $y)
    {
        $this->X = $x;
        $this->Y = $y;
    }

}
class Queue extends SplQueue
{
}






