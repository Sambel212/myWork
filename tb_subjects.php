              <div class="card-body table-responsive">
                <table class="table" id="example3">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Subjects</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $select = $pdo->prepare('SELECT * FROM subject_tb');
                  $select->execute();
                  while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $row->sn; ?></td>
                    <td><?php echo $row->subject_name; ?></td>
                    <td>
                        <a href="edit_category.php?id=<?php echo $row->sn; ?>"
                        class="btn btn-primary btn-sm" name="btn_edit"><i class="fas fa-edit"></i></a>
                        <a href="delete_category.php?id=<?php echo $row->subject_id; ?>"
                        onclick="return confirm('Hapus Kategori?')"
                        class="btn btn-danger btn-sm" name="btn_delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php
                }
                ?>
                  </tbody>
                </table>
              </div>