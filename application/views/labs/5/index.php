<h3>
    Численное интегрирование. Вариант 12
</h3>
<p> Data: </p>
Analitic method - <?= $analitic ?> (By wolfram)
<?php
new arrayTableWidget([
        $lRec, $rRec, $cRec, $trap, $parab,$gauss[0], $gauss[1], $gauss[2],$newton[0], $newton[1],$chebish[0], $chebish[1], $chebish[2]
], [
        'leftRectangle', 'rightRectangle', 'centreRectangle', 'trapeciy', 'parabol','gauss','gauss','gauss','newtonCotes','newtonCotes','chebishev','chebishev','chebishev'
], [
        "", "Count", "Num", "Infelicity"
]);