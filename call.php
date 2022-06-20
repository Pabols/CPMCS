<?php

$temperature=shell_exec("C:/Users/PaBie/AppData/Local/Programs/Python/Python310/python.exe C:/xampp/htdocs/nvsu/call.py ");

echo json_encode(['temperature'=>$temperature]);