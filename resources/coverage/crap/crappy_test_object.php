<?php
$coverage = new SebastianBergmann\CodeCoverage\CodeCoverage;
$coverage->setData(array (
  '/home/narkon/Workspace/landingi/code-quality-tools/src/Coverage/Test/CrappyTestObject.php' => 
  array (
    18 => 
    array (
    ),
    19 => 
    array (
    ),
    20 => 
    array (
    ),
    21 => 
    array (
    ),
    22 => 
    array (
    ),
    23 => 
    array (
    ),
    27 => 
    array (
    ),
    28 => 
    array (
    ),
    29 => 
    array (
    ),
    30 => 
    array (
    ),
    32 => 
    array (
    ),
    33 => 
    array (
    ),
    34 => 
    array (
    ),
    35 => 
    array (
    ),
    36 => 
    array (
    ),
    39 => 
    array (
    ),
    40 => 
    array (
    ),
    41 => 
    array (
    ),
    42 => 
    array (
    ),
    53 => 
    array (
    ),
    54 => 
    array (
    ),
    55 => 
    array (
    ),
    56 => 
    array (
    ),
    59 => NULL,
  ),
));
$coverage->setTests(array (
  'UNCOVERED_FILES_FROM_WHITELIST' => 
  array (
    'size' => 'unknown',
    'status' => -1,
  ),
));

$filter = $coverage->filter();
$filter->setWhitelistedFiles(array (
  '/home/narkon/Workspace/landingi/code-quality-tools/src/Coverage/Test/CrappyTestObject.php' => true,
));

return $coverage;
