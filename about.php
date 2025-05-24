    <?php include 'header.inc';?>
    <!--author details-->
    <meta name="author" content="Moji Alak">
    <title>About Page</title>
</head>

<body class="about">
    <!--Navigation bar with hyperlinks to other pages-->
	<?php include 'nav.inc';?>
    <br>

    <section id="aboutheader">
        <!--imgage of company logo-->
        <img src="images/leafbytetechlogo.png" id="complogo" alt="LeafByte Tech Logo" width="200">
        <h1>About Us</h1>
        <p id="aboutdescript">Here at LeafByte Tech, we are a team of dedicated sofware developers who believe in harnessing the power of Techonology and its potential to improve the world we live in. Leafbyte Tech is all about embracing innovation, imagination, creativity and ingenuity. </p>
    </section>

    <!--Side bar-->
    <aside class="sidebar">
        <!--image of the team-->
        <img src="images/teamphoto.jpg" id="teampic" alt="Team Photo" width="200">
        <p><strong>Class Information</strong></p>
        <!--Unordered list of student's name with nested list for class time and student ID-->
        <ul class="aboutlist">
            <li>Jade Veenstra
                <!--nested list-->
                <ul class="aboutlist">
                    <li>Student ID: 105929618</li>
                    <li>Class Time: 10.30</li>
                </ul>
            </li>
            <li>Will Stevens
                <!--nested list-->
                <ul class="aboutlist">
                    <li>Student ID: 105933787</li>
                    <li>Class Time: 10.30</li>
                </ul>
            </li>
            <li>Muhammad Taki
                <!--nested list-->
                <ul class="aboutlist">
                    <li>Student ID: 105653797</li>
                    <li>Class Time: 10.30</li>
                </ul>
            </li>
            <li>Moji Alak
                <!--nested list-->
                <ul class="aboutlist">
                    <li>Student ID: 105616282</li>
                    <li>Class Time: 10.30</li>
                </ul>
            </li>
        </ul>
    </aside>

    <!--Section for table with team members and interests-->
    <main id="main-table">
        <h2>Meet the Team</h2>
        <table id="abouttable">
            <!--table heading with merged columns-->
            <tr>
                <th class="headerrow" colspan="2">Demographic Information</th>
                <th class="headerrow" colspan="2">Interests and Facts</th>
            </tr>
            <!--table heading with details of content-->
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Favourite Things</th>
                <th>Fun Fact</th>
            </tr>
            <!--table row about Jade-->
            <tr>
                <td>Jade</td>
                <td>18</td>
                <!--cell with unordered list for favourite things-->
                <td>
                    <ul class="tablelist">
                        <li>Food: Ramen</li>
                        <li>Colour: Pink </li>
                        <li>Animal: Cats</li>
                        <li>Season: Autumn</li>
                    </ul>
                </td>
                <td>Jade's home town is a suburb with bush reserves and ponds!</td>
            </tr>
            <!--Table row about Will-->
            <tr>
                <td>Will</td>
                <td>18</td>
                <!--cell with unordered list for favourite things-->
                <td>
                    <ul class="tablelist">
                        <li>Colour: Green</li>
                        <li>Animal: Penguins</li>
                        <li>Season: Winter</li>
                    </ul>
                </td>
                <td>Wills past time activities are tennis and video games!</td>
            </tr>
            <!--Table Row about Taki-->
            <tr>
                <td>Taki</td>
                <td>18</td>
                <!--cell with unordered list for favourite things-->
                <td>
                    <ul class="tablelist">
                        <li>Colour: Red and Black</li>
                        <li>Animal: Lion</li>
                    </ul>
                </td>
                <td>Taki's plays cricket in his free time!</td>
            </tr>
            <!--Table row about Moji-->
            <tr>
                <td>Moji</td>
                <td>21</td>
                <!--cell with unordered list for favourite things-->
                <td>
                    <ul class="tablelist">
                        <li>Food: Korean BBQ</li>
                        <li>Colour: Lilac</li>
                        <li>Animal: Sea Otters</li>
                        <li>Season: Winter</li>
                    </ul>
                </td>
                <td>Moji's home town produces one of the most iconic rums in Australia, Bundaberg Rum!</td>
            </tr>
        </table>
    </main>
    <hr id="line">

    <!--section with Definition List for member name and their contribution-->
    <section id="contributions">
        <h3 class="students">Contributions</h3>
        <dl class="students">
            <dt><strong>Jade Veenstra</strong></dt>
            <dd>Creator of the <a href="index.html" class="aboutlink"><strong>Home</strong></a> Page</dd>
            <dd>Creator of 1, 2, 5, 6, 8.3, and 8.2 in Part A<dd>

            <dt><strong>Will Stevens</strong></dt>
            <dd>Creator of the <a href="apply.html" class="aboutlink"><strong>Apply</strong></a> Page</dd>
            <dd>Creator of 3, 4 and 8.1 in Part A<dd>

            <dt><strong>Muhammad Taki</strong></dt>
            <dd>Creator of the <a href="jobs.html" class="aboutlink"><strong>Position Description</strong></a> Page
            <dd>Creator of 7 and 8.4 in Part A<dd>

            <dt><strong>Moji Alak</strong></dt>
            <dd>Creator of the <a href="about.html" class="aboutlink"><strong>About</strong></a> Page</dd>
        </dl>
        <h3 class="students">Teacher and Lecturer</h3>
        <dl class="students">
            <dt><strong>Rahul R</strong></dt>
            <dd>Teacher</dd>
            <dd>Class: Wednesday 10.30am</dd>

            <dt><strong>Ati Kia</strong></dt>
            <dd>Lecturer</dd>
        </dl>

        <h3 id="finalabout">If you are ready to make your mark within the tech world, <a href="apply.html" class="aboutlink"><strong>JOIN US TODAY</strong></a> in our journey to transform the industry, one byte at a time.</h3>
    </section>

    <!--Footer Section with link to JIRA project-->
    <footer class="footer">
    <?php include 'footer.inc';?>
</body>
</html>