<form action="{!! route('posts.store') !!}" method="post">
    @csrf
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label>Title</label>
                                <input type="text" name="title"  class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Feed</label>
                                <select name="feed" class="form-control">
                                    <option value="public">Public</option>
                                    <option value="off">Only for friends</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea class="tiny_area" name="content" id="editor"></textarea><br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Publish</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="/js/tiny.js"></script>


