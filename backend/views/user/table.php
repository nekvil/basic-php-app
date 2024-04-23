<?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['password']; ?></td>
        <td><?php echo $user['created_at']; ?></td>
        <td>
            <button class="deleteUser btn btn-danger btn-sm" data-id="<?php echo $user['id']; ?>">
                <i class="bi bi-trash"></i>
            </button>
        </td>
    </tr>
<?php endforeach; ?>
