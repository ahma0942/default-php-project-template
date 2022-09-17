<?php
function update($id, $body, $table)
{
    $vals = [];
    $sql = "UPDATE $table SET";
    foreach ($body as $col => $val) {
        $sql .= " $col=?,";
        $vals[] = $val;
    }
    $sql = trim($sql, ',');
    $sql .= " WHERE id=?";
    return DI::database()->sql($sql, array_merge($vals, [$id]));
}

function create($body, $table)
{
    $cols = $vals = $prep = [];
    foreach ($body as $col => $val) {
        $cols[] = $col;
        $vals[] = $val;
        $prep[] = '?';
    }
    $sql = "INSERT INTO $table (" . implode(',', $cols) . ") VALUES (" . implode(',', $prep) . ")";

    return DI::database()->sql($sql, $vals);
}

function delete($id, $table)
{
    return DI::database()->sql("DELETE FROM $table WHERE id = ?", [$id]);
}
