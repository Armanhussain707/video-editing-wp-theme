<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="searchModalLabel">Search</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="get" action="<?php echo home_url('/'); ?>">
          <div class="input-group">
            <input type="text" name="s" class="form-control" placeholder="Type to search..." />
            <button type="submit" class="btn btn-primary">Go</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
