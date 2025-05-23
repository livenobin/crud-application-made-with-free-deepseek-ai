                <div class="col-md-12" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #f0f0f0; text-align: center; padding: 4px;margin-top: 35px;">
                  <small>CRUD Application <big>95%</big> build with free Deepseek AI by <a target="_blank" href="https://x.com/livenobin">@livenobin</a></small>
                </div>
    
        </div> <!-- Close main-content div -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('.table').DataTable({
              responsive: true
            });
            
            // Confirm before delete
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                if(confirm('Are you sure you want to delete this item?')) {
                    window.location.href = $(this).attr('href');
                }
            });
            
            // Sidebar toggle functionality
            $('#sidebarToggle').on('click', function(e) {
                e.stopPropagation(); // Prevent event bubbling
                $('#sidebar').toggleClass('active');
                $('#mainContent').toggleClass('active');
            });
            
            // Close sidebar when clicking outside on mobile
            // Close sidebar when clicking outside or on a nav link
            $(document).on('click', function(e) {
                if ($(window).width() <= 768) {
                    // If clicking outside the sidebar when it's open
                    if (!$(e.target).closest('#sidebar').length && 
                        !$(e.target).is('#sidebarToggle') && 
                        $('#sidebar').hasClass('active')) {
                        $('#sidebar').removeClass('active');
                        $('#mainContent').removeClass('active');
                    }
                    
                    // If clicking a nav link
                    if ($(e.target).closest('.nav-link').length) {
                        $('#sidebar').removeClass('active');
                        $('#mainContent').removeClass('active');
                    }
                }
            });

            // Prevent sidebar close when clicking inside it
            $('#sidebar').on('click', function(e) {
                e.stopPropagation();
            });

            //touch
            // Add swipe to close functionality
            let touchStartX = 0;
            let touchEndX = 0;

            document.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, false);

            document.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                if (touchStartX - touchEndX > 50 && $('#sidebar').hasClass('active')) {
                    $('#sidebar').removeClass('active');
                    $('#mainContent').removeClass('active');
                }
            }, false);
        });
    </script>
</body>
</html>