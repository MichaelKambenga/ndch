<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here

        $model = app\models\WeatherData::findAll(['EntryDate' => '2017-05-08 22:14:53']);

        echo '<table>';
        echo '<tr>';
        echo '<th>';
        echo '#';
        echo '</th>';
        echo '<th>';
        echo 'RH';
        echo '</th>';
        echo '<th>';
        echo 'SR';
        echo '</th>';
        echo '<th>';
        echo 'TA';
        echo '</th>';
        echo '<th>';
        echo 'WD';
        echo '</th>';
        echo '<th>';
        echo 'PA';
        echo '</th>';
        echo '</tr>';

        $i = 1;
        foreach ($model as $item) {
            echo '<tr>';
            echo '<td>';
            echo $i;
            echo '</td>';
            echo '<td>';
            echo $item->RH;
            echo '</td>';
            echo '<td>';
            echo $item->SR;
            echo '</td>';
            echo '<td>';
            echo $item->TA;
            echo '</td>';
            echo '<td>';
            echo $item->WD;
            echo '</td>';
            echo '<td>';
            echo $item->PA;
            echo '</td>';
            echo '</tr>';
            $i++;
        }
        echo '</table>';
        ?>

        <table> 
            <tr>
                <td>

                </td>
            </tr>
        </table>
    </body>
</html>
