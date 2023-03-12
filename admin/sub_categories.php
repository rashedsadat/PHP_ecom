<?php
require('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    // to change status
    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if ($operation == 'active') {
            $status = 1;
        } elseif ($operation == 'deactive') {
            $status = 0;
        }
        $update_status_sql = "update sub_categories set status = '$status' where id = '$id'";
        mysqli_query($con, $update_status_sql);
    }

    // delete categories
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from sub_categories where id = '$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select sub_categories.*, categories.categories from sub_categories, categories where sub_categories.category_id = categories.id order by sub_categories.id desc";
$result = mysqli_query($con, $sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Sub Categories </h4>
                        <h4 class="box-title"><a class="btn btn-success" href="manage_sub_categories.php">Add Sub Categories </a> </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID</th>
                                        <th>Categories</th>
                                        <th>Sub Categories</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td class="serial"><?php echo $i; ?>.</td>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['categories']; ?></td>
                                            <td><?php echo $row['sub_categories']; ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo "<a class='btn btn-success' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>&nbsp;";
                                                } else {
                                                    echo "<a class='btn btn-secondary' href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a>&nbsp;";
                                                }

                                                // for edit categories
                                                echo "<a class='btn btn-warning' href='manage_sub_categories.php?id=" . $row['id'] . "'>Edit</a>&nbsp;";

                                                // for delete categories
                                                echo "<a class='btn btn-danger' href='?type=delete&id=" . $row['id'] . "'>Delete</a>&nbsp;";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require('footer.inc.php');
?>
