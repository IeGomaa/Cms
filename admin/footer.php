
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0-rc
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../assets/back/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../assets/back/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/back/dist/js/adminlte.min.js"></script>

<!-- Summernote -->
<script src="../../assets/back/plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="../../assets/back/plugins/codemirror/codemirror.js"></script>
<script src="../../assets/back/plugins/codemirror/mode/css/css.js"></script>
<script src="../../assets/back/plugins/codemirror/mode/xml/xml.js"></script>
<script src="../../assets/back/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>

</body>
</html>
