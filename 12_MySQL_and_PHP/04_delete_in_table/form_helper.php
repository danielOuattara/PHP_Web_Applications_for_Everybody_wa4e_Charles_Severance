<?php

function delete_helper($id)
{
    echo "
    <form method='post'>
        <input type='hidden' name='user_id' value= $id>
        <input type='submit' value='Delete' name='delete' />
    </form>";
}
