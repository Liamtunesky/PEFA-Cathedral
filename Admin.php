<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Admin Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin.css">
</head>

<body>
  <nav class="sidebar">
    <div class="sidebar-top-wrapper">
      <div class="sidebar-top">
        <a href="#" class="logo__wrapper">
          <img src="/images/pefa.png" alt="Logo" class="logo-small">
          <span class="hide company-name">
            PEFA Admin
          </span>
        </a>
      </div>
      <button class="expand-btn" type="button">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M6.00979 2.72L10.3565 7.06667C10.8698 7.58 10.8698 8.42 10.3565 8.93333L6.00979 13.28"
            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>
    </div>
    <div class="sidebar-links-wrapper">
      <div class="sidebar-links">
        <ul>
          <li>
            <a href="#dashboard" title="Dashboard" class="tooltip">
              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M1.82764 11.8634C1.82764 8.49248 1.82764 6.80699 2.57126 5.61223C2.84639 5.17021 3.18813 4.78574 3.58105 4.47623C4.64306 3.63965 6.14126 3.63965 9.13767 3.63965H12.7927C15.7891 3.63965 17.2873 3.63965 18.3493 4.47623C18.7422 4.78574 19.084 5.17021 19.3591 5.61223C20.1027 6.80699 20.1027 8.49248 20.1027 11.8634C20.1027 15.2344 20.1027 16.9199 19.3591 18.1146C19.084 18.5567 18.7422 18.9411 18.3493 19.2506C17.2873 20.0872 15.7891 20.0872 12.7927 20.0872H9.13767C6.14126 20.0872 4.64306 20.0872 3.58105 19.2506C3.18813 18.9411 2.84639 18.5567 2.57126 18.1146C1.82764 16.9199 1.82764 15.2344 1.82764 11.8634Z"
                  stroke="#141B34" stroke-width="1.4" />
                <path d="M8.68066 3.63965L8.68066 20.0872" stroke="#141B34" stroke-width="1.4"
                  stroke-linejoin="round" />
                <path d="M4.56885 7.29492H5.4826M4.56885 10.0362H5.4826" stroke="#141B34" stroke-width="1.4"
                  stroke-linecap="round" stroke-linejoin="round" />
              </svg>

              <span class="link hide">Dashboard</span>
              <div id="workspace">
                <!-- Workspace content will be loaded here -->

            </div>
            </a>
          </li>
        </ul>
        <h2>Ministry</h2>
        <div class="divider"></div>
        <ul>

          <li>
            <a href="#team" title="Team" class="tooltip">
              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_15_5297)">
                  <path
                    d="M18.9821 17.2756C19.6667 17.2756 20.2113 16.8447 20.7003 16.2423C21.7013 15.009 20.0578 14.0234 19.431 13.5407C18.7938 13.05 18.0824 12.7721 17.361 12.7068M16.4473 10.8793C17.7089 10.8793 18.7317 9.85656 18.7317 8.59493C18.7317 7.3333 17.7089 6.31055 16.4473 6.31055"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" />
                  <path
                    d="M2.94755 17.2756C2.26287 17.2756 1.71829 16.8447 1.22932 16.2423C0.22834 15.009 1.8718 14.0234 2.49861 13.5407C3.1358 13.05 3.84726 12.7721 4.56859 12.7068M5.02547 10.8793C3.76384 10.8793 2.74108 9.85656 2.74108 8.59493C2.74108 7.3333 3.76384 6.31055 5.02547 6.31055"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" />
                  <path
                    d="M7.38635 14.6364C6.4527 15.2138 4.00471 16.3926 5.4957 17.8677C6.22403 18.5883 7.03521 19.1036 8.05506 19.1036H13.8745C14.8944 19.1036 15.7056 18.5883 16.4339 17.8677C17.9249 16.3926 15.4769 15.2138 14.5432 14.6364C12.3538 13.2826 9.57576 13.2826 7.38635 14.6364Z"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                    d="M14.1629 7.68154C14.1629 9.44782 12.731 10.8797 10.9647 10.8797C9.19846 10.8797 7.7666 9.44782 7.7666 7.68154C7.7666 5.91525 9.19846 4.4834 10.9647 4.4834C12.731 4.4834 14.1629 5.91525 14.1629 7.68154Z"
                    stroke="#141B34" stroke-width="1.4" />
                </g>
                <defs>
                  <clipPath id="clip0_15_5297">
                    <rect width="21.9301" height="21.9301" fill="white" transform="translate(0 0.828125)" />
                  </clipPath>
                </defs>
              </svg>

                <span class="link hide">Men Ministry</span>
            </a>
          
          <li>
            <a href="#team" title="Team" class="tooltip">
              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_15_5297)">
                  <path
                    d="M18.9821 17.2756C19.6667 17.2756 20.2113 16.8447 20.7003 16.2423C21.7013 15.009 20.0578 14.0234 19.431 13.5407C18.7938 13.05 18.0824 12.7721 17.361 12.7068M16.4473 10.8793C17.7089 10.8793 18.7317 9.85656 18.7317 8.59493C18.7317 7.3333 17.7089 6.31055 16.4473 6.31055"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" />
                  <path
                    d="M2.94755 17.2756C2.26287 17.2756 1.71829 16.8447 1.22932 16.2423C0.22834 15.009 1.8718 14.0234 2.49861 13.5407C3.1358 13.05 3.84726 12.7721 4.56859 12.7068M5.02547 10.8793C3.76384 10.8793 2.74108 9.85656 2.74108 8.59493C2.74108 7.3333 3.76384 6.31055 5.02547 6.31055"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" />
                  <path
                    d="M7.38635 14.6364C6.4527 15.2138 4.00471 16.3926 5.4957 17.8677C6.22403 18.5883 7.03521 19.1036 8.05506 19.1036H13.8745C14.8944 19.1036 15.7056 18.5883 16.4339 17.8677C17.9249 16.3926 15.4769 15.2138 14.5432 14.6364C12.3538 13.2826 9.57576 13.2826 7.38635 14.6364Z"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                    d="M14.1629 7.68154C14.1629 9.44782 12.731 10.8797 10.9647 10.8797C9.19846 10.8797 7.7666 9.44782 7.7666 7.68154C7.7666 5.91525 9.19846 4.4834 10.9647 4.4834C12.731 4.4834 14.1629 5.91525 14.1629 7.68154Z"
                    stroke="#141B34" stroke-width="1.4" />
                </g>
                <defs>
                  <clipPath id="clip0_15_5297">
                    <rect width="21.9301" height="21.9301" fill="white" transform="translate(0 0.828125)" />
                  </clipPath>
                </defs>
              </svg>

                <span class="link hide">Women Ministry</span>
            </a>
          </li>
          <li>
            <a href="#team" title="Team" class="tooltip">
              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_15_5297)">
                  <path
                    d="M18.9821 17.2756C19.6667 17.2756 20.2113 16.8447 20.7003 16.2423C21.7013 15.009 20.0578 14.0234 19.431 13.5407C18.7938 13.05 18.0824 12.7721 17.361 12.7068M16.4473 10.8793C17.7089 10.8793 18.7317 9.85656 18.7317 8.59493C18.7317 7.3333 17.7089 6.31055 16.4473 6.31055"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" />
                  <path
                    d="M2.94755 17.2756C2.26287 17.2756 1.71829 16.8447 1.22932 16.2423C0.22834 15.009 1.8718 14.0234 2.49861 13.5407C3.1358 13.05 3.84726 12.7721 4.56859 12.7068M5.02547 10.8793C3.76384 10.8793 2.74108 9.85656 2.74108 8.59493C2.74108 7.3333 3.76384 6.31055 5.02547 6.31055"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" />
                  <path
                    d="M7.38635 14.6364C6.4527 15.2138 4.00471 16.3926 5.4957 17.8677C6.22403 18.5883 7.03521 19.1036 8.05506 19.1036H13.8745C14.8944 19.1036 15.7056 18.5883 16.4339 17.8677C17.9249 16.3926 15.4769 15.2138 14.5432 14.6364C12.3538 13.2826 9.57576 13.2826 7.38635 14.6364Z"
                    stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                    d="M14.1629 7.68154C14.1629 9.44782 12.731 10.8797 10.9647 10.8797C9.19846 10.8797 7.7666 9.44782 7.7666 7.68154C7.7666 5.91525 9.19846 4.4834 10.9647 4.4834C12.731 4.4834 14.1629 5.91525 14.1629 7.68154Z"
                    stroke="#141B34" stroke-width="1.4" />
                </g>
                <defs>
                  <clipPath id="clip0_15_5297">
                    <rect width="21.9301" height="21.9301" fill="white" transform="translate(0 0.828125)" />
                  </clipPath>
                </defs>
              </svg>

                <span class="link hide">Youth Ministry</span>
            </a>
          </li>
        </ul>
        <h2>Management</h2>
        <div class="divider"></div>
        <ul>

          <li>
            <a href="#time-tracking" title="Time Tracking" class="tooltip">
              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.4475 2.49023V4.31774M5.48242 2.49023V4.31774" stroke="#141B34" stroke-width="1.4"
                  stroke-linecap="round" stroke-linejoin="round" />
                <path
                  d="M10.961 12.542H10.9692M10.961 16.197H10.9692M14.6119 12.542H14.6201M7.31006 12.542H7.31826M7.31006 16.197H7.31826"
                  stroke="#141B34" stroke-width="1.59" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3.19775 7.97266H18.7316" stroke="#141B34" stroke-width="1.4" stroke-linecap="round"
                  stroke-linejoin="round" />
                <path
                  d="M2.28418 11.8503C2.28418 7.86884 2.28418 5.87809 3.42831 4.64119C4.57244 3.4043 6.41388 3.4043 10.0968 3.4043H11.8329C15.5158 3.4043 17.3573 3.4043 18.5014 4.64119C19.6455 5.87809 19.6455 7.86884 19.6455 11.8503V12.3196C19.6455 16.3011 19.6455 18.2918 18.5014 19.5287C17.3573 20.7656 15.5158 20.7656 11.8329 20.7656H10.0968C6.41388 20.7656 4.57244 20.7656 3.42831 19.5287C2.28418 18.2918 2.28418 16.3011 2.28418 12.3196V11.8503Z"
                  stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M2.74121 7.97266H19.1888" stroke="#141B34" stroke-width="1.4" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
              <span class="link hide">Member Management</span>
            </a>
          </li>
          <li>
            <a href="#time-tracking" title="Time Tracking" class="tooltip">
              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.4475 2.49023V4.31774M5.48242 2.49023V4.31774" stroke="#141B34" stroke-width="1.4"
                  stroke-linecap="round" stroke-linejoin="round" />
                <path
                  d="M10.961 12.542H10.9692M10.961 16.197H10.9692M14.6119 12.542H14.6201M7.31006 12.542H7.31826M7.31006 16.197H7.31826"
                  stroke="#141B34" stroke-width="1.59" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3.19775 7.97266H18.7316" stroke="#141B34" stroke-width="1.4" stroke-linecap="round"
                  stroke-linejoin="round" />
                <path
                  d="M2.28418 11.8503C2.28418 7.86884 2.28418 5.87809 3.42831 4.64119C4.57244 3.4043 6.41388 3.4043 10.0968 3.4043H11.8329C15.5158 3.4043 17.3573 3.4043 18.5014 4.64119C19.6455 5.87809 19.6455 7.86884 19.6455 11.8503V12.3196C19.6455 16.3011 19.6455 18.2918 18.5014 19.5287C17.3573 20.7656 15.5158 20.7656 11.8329 20.7656H10.0968C6.41388 20.7656 4.57244 20.7656 3.42831 19.5287C2.28418 18.2918 2.28418 16.3011 2.28418 12.3196V11.8503Z"
                  stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M2.74121 7.97266H19.1888" stroke="#141B34" stroke-width="1.4" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
              <span class="link hide">Event Management</span>
            </a>
          </li>
          <li>
            <a href="#time-tracking" title="Time Tracking" class="tooltip">
              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.4475 2.49023V4.31774M5.48242 2.49023V4.31774" stroke="#141B34" stroke-width="1.4"
                  stroke-linecap="round" stroke-linejoin="round" />
                <path
                  d="M10.961 12.542H10.9692M10.961 16.197H10.9692M14.6119 12.542H14.6201M7.31006 12.542H7.31826M7.31006 16.197H7.31826"
                  stroke="#141B34" stroke-width="1.59" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3.19775 7.97266H18.7316" stroke="#141B34" stroke-width="1.4" stroke-linecap="round"
                  stroke-linejoin="round" />
                <path
                  d="M2.28418 11.8503C2.28418 7.86884 2.28418 5.87809 3.42831 4.64119C4.57244 3.4043 6.41388 3.4043 10.0968 3.4043H11.8329C15.5158 3.4043 17.3573 3.4043 18.5014 4.64119C19.6455 5.87809 19.6455 7.86884 19.6455 11.8503V12.3196C19.6455 16.3011 19.6455 18.2918 18.5014 19.5287C17.3573 20.7656 15.5158 20.7656 11.8329 20.7656H10.0968C6.41388 20.7656 4.57244 20.7656 3.42831 19.5287C2.28418 18.2918 2.28418 16.3011 2.28418 12.3196V11.8503Z"
                  stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M2.74121 7.97266H19.1888" stroke="#141B34" stroke-width="1.4" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
              <span class="link hide">Admin Privileges</span>
            </a>
          </li>
          <li>
            <a href="#time-tracking" title="Time Tracking" class="tooltip">
            <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.4475 2.49023V4.31774M5.48242 2.49023V4.31774" stroke="#141B34" stroke-width="1.4"
                stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M10.961 12.542H10.9692M10.961 16.197H10.9692M14.6119 12.542H14.6201M7.31006 12.542H7.31826M7.31006 16.197H7.31826"
                stroke="#141B34" stroke-width="1.59" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M3.19775 7.97266H18.7316" stroke="#141B34" stroke-width="1.4" stroke-linecap="round"
                stroke-linejoin="round" />
              <path
                d="M2.28418 11.8503C2.28418 7.86884 2.28418 5.87809 3.42831 4.64119C4.57244 3.4043 6.41388 3.4043 10.0968 3.4043H11.8329C15.5158 3.4043 17.3573 3.4043 18.5014 4.64119C19.6455 5.87809 19.6455 7.86884 19.6455 11.8503V12.3196C19.6455 16.3011 19.6455 18.2918 18.5014 19.5287C17.3573 20.7656 15.5158 20.7656 11.8329 20.7656H10.0968C6.41388 20.7656 4.57244 20.7656 3.42831 19.5287C2.28418 18.2918 2.28418 16.3011 2.28418 12.3196V11.8503Z"
                stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M2.74121 7.97266H19.1888" stroke="#141B34" stroke-width="1.4" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
            <span class="link hide">Sermon Management</span>
          </a></li>
          <li>
            <a href="#incentives" title="Incentives" class="tooltip">
              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M18.4561 3.19434L3.47422 3.19434C2.78842 3.19434 2.44551 3.19434 2.2081 3.35631C2.0905 3.43653 1.99333 3.54256 1.92419 3.66608C1.7846 3.91548 1.81872 4.2524 1.88696 4.92624C2.00086 6.05095 2.05781 6.61331 2.35599 7.01537C2.50458 7.21572 2.69297 7.38407 2.90965 7.51013C3.34446 7.76311 3.9168 7.76311 5.06148 7.76311L16.8689 7.76311C18.0136 7.76311 18.5859 7.76311 19.0207 7.51013C19.2374 7.38407 19.4258 7.21572 19.5744 7.01537C19.8725 6.61331 19.9295 6.05095 20.0434 4.92624C20.1116 4.2524 20.1458 3.91548 20.0062 3.66608C19.937 3.54256 19.8399 3.43653 19.7223 3.35631C19.4848 3.19434 19.1419 3.19434 18.4561 3.19434Z"
                  stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                <path
                  d="M2.74121 7.7627L2.74121 12.3688C2.74121 15.7972 2.74121 17.5114 3.81174 18.5764C4.88227 19.6415 6.60526 19.6415 10.0512 19.6415H11.8788C15.3247 19.6415 17.0477 19.6415 18.1183 18.5764C19.1888 17.5114 19.1888 15.7972 19.1888 12.3688V7.7627"
                  stroke="#141B34" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.1377 10.5039L12.7927 10.5039" stroke="#141B34" stroke-width="1.4" stroke-linecap="round" />
              </svg>
              <span class="link hide">Receipts</span>
            </a>
          </li>
          <img src="/images/admin.png" alt="Admin Logo" class="logo-small">
            
    </div>
    
  </nav>
  <script src="admin.js"></script>
  
</body>

</html>
<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar 
            <div class="col-md-3 col-lg-2 bg-dark sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        
                        <li class="nav-item">
                            
                            <a class="nav-link active" href="#">
                                Dashboard
                            </a>
                        </li>
                        <script>
                            function showTab(tabName) {
                                // Hide all tab content
                                var tabContents = document.querySelectorAll('.tab-content');
                                tabContents.forEach(function(tab) {
                                    tab.classList.remove('active');
                                });
                                
                                // Show the selected tab content
                                var selectedTab = document.getElementById(tabName);
                                if (selectedTab) {
                                    selectedTab.classList.add('active');
                                }
                            }
                        </script>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Membership Registration
                            </a>
                            <select onchange="showAdditionalFields(this)">
                                <option value="basic">Basic</option>
                                <option value="premium">Premium</option>
                                <option value="other">Other</option>
                            </select>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Member Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Event Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Admin Privileges
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Financial Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Prayer Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Attendance Tracking
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Calendar of Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Youth Ministry
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Men Ministry
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Women Ministry
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Mission and Outreach
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Sermon Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Reports and analytics
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content 
            <div class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h1 class="mt-4">Dashboard</h1>
                <div class="row">
                    <!-- Members Summary 
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Members</h5>
                                <p class="card-text">Total: 500</p>
                                <a href="#" class="btn btn-primary">View Members</a>
                            </div>
                        </div>
                    </div>
                    <!-- Events Summary 
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Events</h5>
                                <p class="card-text">Upcoming: 10</p>
                                <a href="#" class="btn btn-primary">View Events</a>
                            </div>
                        </div>
                    </div>
                    <!-- Finances Summary 
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Finances</h5>
                                <p class="card-text">Total Donation: $10,000</p>
                                <a href="#" class="btn btn-primary">View Finances</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Additional Dashboard Widgets 
                <div class="row mt-4">
                    <!-- Recent Members
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Members</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">John Doe - Joined 3 days ago</li>
                                    <li class="list-group-item">Jane Smith - Joined 5 days ago</li>
                                    <li class="list-group-item">David Johnson - Joined 1 week ago</li>
                                    <!-- Add more recent members as needed 
                                </ul>
                                <a href="#" class="btn btn-primary mt-3">View All Members</a>
                            </div>
                        </div>
                    </div>
                    <!-- Upcoming Events 
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Upcoming Events</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Sunday Service - Tomorrow at 9:00 AM</li>
                                    <li class="list-group-item">Bible Study - Next Wednesday at 7:00 PM</li>
                                    <!-- Add more upcoming events as needed 
                                </ul>
                                <a href="#" class="btn btn-primary mt-3">View All Events</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>-->