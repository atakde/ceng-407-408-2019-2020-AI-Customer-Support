<?php
include 'header.php';
$AllUsers = $conne->selectAll("users");
?>
<body>
    <div class="container">
        <form>
            <input type="text" id="name" placeholder="Name">
            <input type="text" id="email" placeholder="Email Address">
            <input type="button" class="add-row" value="Add">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Fullname</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($AllUsers as $key) { ?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $key['user_id'] ?>" name="record"></td>
                        <td><?php echo $key["username"] ?></td>
                        <td><?php echo $key["email"] ?></td>
                        <td><?php echo $key["firstname"].' '.$key["surname"];?></td>
                        <td><?php if($key["is_admin"]) echo "Yes"; else echo "No"; ?></td>
                    </tr>
                <? } ?>
            </tbody>
        </table>
        <button type="button" class="delete-row">Delete</button>
    </div>
</body>
<script>
    $(document).ready(function(){
        $(".add-row").click(function(){
            var username = $("#name").val();
            var email = $("#email").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + email + "</td></tr>";
            $("table tbody").append(markup);
            var action = "addUser";
            $.ajax({
                url:"/action.php",
                method:"POST",
                data: {username:username, email:email, action:action},
                success:function(response){
                    alert(response);
                }       
            })
        });
        
        $(".delete-row").click(function(){
            var action = "deleteUser";
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    var value = $(this).val();
                    $(this).parents("tr").remove();
                    $.ajax({
                        url:"/action.php",
                        method:"POST",
                        data: {user_id:value, action:action},
                        success:function(response){
                            alert(response);
                        }
                    });
                }
            });
        });
    });    
</script>