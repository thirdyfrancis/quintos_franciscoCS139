<div class="modal fade" id="add_animals" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Animals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="animals/add_animals.php" method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="animals_name" name="animals_name" placeholder="Animals Name" required>
                        <label for="floatingInput">Animals Name</label>
                    </div>
                    
                    <div class="form-floating mb-3">

                        <?php
                            $database = new Connection();
                            $db = $database->open();
                        ?>
                        <select class="form-select" id="type_id" name="type_id" aria-label="Floating label select example">
                            <?php
                                $sql = "SELECT * FROM type";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $types = $stmt->fetchAll();
                            ?>
                            <option selected>None</option>
                            <?php foreach($types as $type): ?>
                                <option value="<?= $type['id']; ?>"><?= $type['name']; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <label for="floatingSelect">Types of Animals</label>
                        <?php
                            $database->close();
                        ?>
                    </div>
                        
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="animals_color" name="animals_color" placeholder="Animals Color">
                        <label for="floatingInput">Animals Color</label>
                    </div>  

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="num_legs" name="num_legs" placeholder="Number of Legs">
                        <label for="floatingInput">Number of Legs</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="animals_remarks" name="animals_remarks" placeholder="Remarks">
                        <label for="floatingInput">Remarks</label>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>