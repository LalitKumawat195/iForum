<!-- Bootstrap 5.3 and Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="threadModal" tabindex="-1" aria-labelledby="threadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h2 class="modal-title fs-4" id="threadModalLabel">Ask a Question</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
            <form action="partials/_insertthread.php" method="POST">
                <div class="mb-3">
                    <label for="thread_title" class="form-label">Thread Title</label>
                    <input type="text" class="form-control" id="thread_title" name="title"
                        placeholder="Enter a short and descriptive title" required>
                </div>

                <div class="mb-3">
                    <label for="thread_desc" class="form-label">Thread Description</label>
                    <textarea class="form-control" id="thread_desc" name="desc" rows="5"
                        placeholder="Describe your question in detail..." required></textarea>
                </div>

                <!-- Hidden input to pass category ID if needed -->
                <input type="hidden" name="thread_cat_id" value="<?php echo $_GET['thread_cat_id']; ?>">

                <button type="submit" class="btn btn-success">Post Thread</button>
            </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <small class="text-muted">iForum © 2025. All rights reserved.</small>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->

<style>
.modal-content {
    font-family: 'Raleway', sans-serif;
}
</style>