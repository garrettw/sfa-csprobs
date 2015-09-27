<p>Given a sequence of ASCII characters terminated by '#', convert each continuous sequence of numeric digits in the string to a decimal number.</p>
<dl>
    <dt>Continuous sequence of numeric digits</dt>
    <dd>begins with a digit and is terminated by a non-digit ASCII character</dd>
</dl>
<p>Print the value of each number (one per numbered line) that is embedded in the sequence of characters and for those numbers that are powers of 2, print what power they are.</p>
<hr>
<pre>
<?php
$input = '1234ab97.4275$,() 6439   256 xy&24%128/2ato2147483648*369@ 0w 65536.5"rst#46935+422';


$input = substr($input, 0, strpos($input, '#'));
preg_match_all('/(\d+)/', $input, $matches);

function get2power ($num) {
    if ($num & 1) return false; // if $num is odd then it can't be a power of 2

    $countOneBits = 0;

    for ($shifts = 0; $num > 1 && $countOneBits <= 1; $shifts++) {
        $num >>= 1;
        $countOneBits += (int) ($num & 1);
    }

    if ($countOneBits !== 1) return false;
    return $shifts;
}

echo "Seq #\tNumber\t\tPower of 2\n";

foreach ($matches[1] as $i => $match) {
    echo ($i+1) . ".\t$match\t\t" . get2power($match) . "\n";
}
