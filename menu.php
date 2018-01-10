  
<div class="menu" style="margin-right: 280px; margin-top: 20px; ">
    <?php
    if (!isset($_SESSION['ID'])) {?>
     <ul>
       <li class="current"><a href="logout.php">Logout</a></li>
       <li ><a href="search.php">Search</a></li>
     </ul> 
        <?php } ?>
          <?php
        if (isset($_SESSION['ID'])) {?> 
          <?php 
          include 'connection.php'; 
          $level =sqlsrv_query( $conn, "SELECT access FROM Logins where Id_no = '" . ($_SESSION['ID']). "'  ");
          $row = sqlsrv_fetch_array($level);
          if ($row['access'] == "Admin"){
          ?>
            <ul>
              <li class="current"><a href="logout.php">Logout</a></li>
              </li><li><a href="search.php">Search</a></li>
              <li><a href="#">Record List ￬</a>
            <ul class="hidden"><!-- Hidden navigational menu that drop on mouse hover. -->
              <li><a href="userlist.php">View Users</a></li>
              <li><a href="loglist.php">View Logs</a></li>
              <li><a href="printlist.php">Print Logs</a></li>
              <li><a href="proplist.php">Property List</a></li>
              <li><a href="transferlist.php">Transfer List</a></li>
              <li><a href="allotmentlist.php">AllotmentRequest</a></li>
              <li><a href="allotmentlistapp.php">AllotmentApproved</a></li>
              <li><a href="files.php">Files Uploaded</a></li>
            </ul>
              </li>
              <li><a href="#">Registration ￬</a>
            <ul class="hidden">
              <li class="current"> <a href="member.php">PropertyRegistration </a> </li>
              <li><a href="registration.php">UserRegistration </a>  </li> 
              <li><a href="transfer.php">Transfer</a></li>
              <li><a href="allotment.php">AllotmentRequest </a></li>
              <li><a href="setups.php">Setup Zones</a></li>
            </ul>
              </li>
            </ul> 
            <?php } elseif ($row['access'] == "Read") { ?>
                <ul>
                  <li><a href="logout.php">Logout</a></li>
                  </li><li><a href="search.php">Search</a></li>
                  <li><a href="#">Record List ￬</a>
                <ul class="hidden"><!-- Hidden navigational menu that drop on mouse hover. -->
                  <li><a href="userlist.php">View Users</a></li>
                  <li><a href="transferlist.php">TransferList</a></li>
                  <li><a href="allotmentlist.php">AllotmentList</a></li>
                  <li><a href="setuplist.php">SetupList</a></li>
                </ul>
                  </li>
                  <li class="current"> <a href="proplist.php">PropertyList</a> </li> 
                </ul> 
                  <?php } elseif ($row['access'] == "Write") { ?>
                    <ul>
                        <li><a href="logout.php">Logout</a></li>
                        </li><li><a href="search.php">Search</a></li>
                        <li><a href="#">Registration ￬</a>
                    <ul class="hidden"><!-- Hidden navigational menu that drop on mouse hover. -->
                        <li><a href="transfer.php">Transfer</a></li>
                        <li><a href="allotment.php">Allotment </a></li>
                        <li><a href="setups.php">Setup Zones </a></li>
                    </ul>
                        </li>
                        <li class="current"> <a href="member.php">Property Registration </a> </li> 
                    </ul> 
                      <?php } elseif ($row['access'] == "Modify") { ?>
                          <ul>
                            <li><a href="logout.php">Logout</a></li>
                            </li><li><a href="search.php">Search</a></li>
                            <li><a href="#">Record List ￬</a>
                          <ul class="hidden"><!-- Hidden navigational menu that drop on mouse hover. -->
                            <li><a href="userlist.php">View Users</a></li>
                            <li><a href="transferlist.php">TransferList</a></li>
                            <li><a href="allotmentlist.php">AllotmentList </a></li>
                          </ul>
                            </li>
                            <li><a href="#">Registration ￬</a>
                          <ul class="hidden"><!-- Hidden navigational menu that drop on mouse hover. -->
                            <li><a href="transfer.php">Transfer</a></li>
                            <li><a href="allotment.php">Allotment </a></li>
                            <li><a href="setups.php">Setup Zones </a></li>
                            <li class="current"> <a href="proplist.php">Property</a> </li>  
                          </ul>
                            </li> 
                          </ul>
                           <?php } else {
                              ?>
                              <ul>
                                <li><a href="logout.php">Logout</a></li>
                                </li><li class="current"><a href="search.php">Search</a></li>
                                <li><a href="view.php">View Details</a></li>
                              </ul>
            <?php } ?>
      <?php } ?>
</div>