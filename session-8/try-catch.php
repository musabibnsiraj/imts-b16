<?php
function divide($x, $y)
{
    if ($y == 0) {
        throw new Exception("Cannot divide by zero.");
    }

    return $x / $y;
}

try {
    echo divide(5, 0);
} catch (Exception $e) {
    echo 'Caught exception msg: ',  $e->getMessage(), "<br>";
    echo 'Caught line: ',  $e->getLine(), "<br>";
    echo 'Caught code: ',  $e->getCode(), "<br>";
    echo 'Caught file: ',  $e->getFile(), "<br>";
} finally {
    echo '<br><br><br>';
    echo 'Finally block executed.';
}

echo '<br><br><br>';
echo 'Hello';
