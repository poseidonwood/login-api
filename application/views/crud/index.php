<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>proses View</title>
</head>

<body>
  <h3>ini proses</h3>
  <a href="<?= base_url('/home/signup'); ?>">Tambah Data</a>
  <table border="2">
    <tr>
      <td>No</td>
      <td>Nama</td>
      <td>Email</td>
      <td>Phone</td>
      <td>Created</td>
      <td>Action</td>
    </tr>
    <?php $no = 1;
    foreach ($content->result() as $key) : ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $key->nama; ?></td>
        <td><?= $key->email; ?></td>
        <td><?= $key->phone; ?></td>
        <td><?= $key->created_time; ?></td>
        <td><a href="<?= base_url(); ?>proses/delete/<?= $key->id_user; ?>">delete</a> </td>
      </tr>
    <?php endforeach ?>
  </table>
</body>

</html>