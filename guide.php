<?php
$title = 'Guide';
require './assets/includes/header.php';
?>
    <nav class="navbar bg-body-tertiary shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php"  style="color:#000;">
                <img src="./assets/images/logo.png" alt="Logo" height="24" class="d-inline-block align-text-top">
                Resumify
            </a>
            <div>
                <a onclick="history.back()" class="btn btn-sm btn-dark"><i class="bi bi-arrow-bar-left"></i> 
                Back  
            </a>
            </div>
        </div>
    </nav>
<style>
        body {
            background-color: #f0f4f8;
            color: #333;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 60px 20px;
            text-align: center;
            border-bottom: 5px solid #495057;
        }
        .headerr {
            margin-top: 40px;
            margin-bottom: 70px;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
            border-top: 5px solid #495057;
        }
        .footer p {
            margin: 0;
        }
        .content {
            padding: 60px 20px;
        }
        .section {
            margin-bottom: 60px;
        }
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 40px;
            position: relative;
            color: #495057;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            
        }
        .do-dont-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        .do-dont-card-header {
            background-color: #000;
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 20px;
        }
        .do-dont-card-body {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 0 0 12px 12px;
        }
        .do-dont-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .do-dont-list li {
            font-size: 1.2rem;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .do-dont-list li:hover {
            background-color: #e9ecef;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 1rem;
        }
        .btn-custom:hover {
            background-color: #17a589;
        }
        .example {
            border-left: 6px solid #000;
            padding-left: 30px;
            margin-bottom: 40px;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .example p {
            margin: 0;
            font-size: 1.1rem;
        }
        .d-flex a {
            margin-right: 15px;
        }
        .resource-link {
            color: #000;
            text-decoration: none;
        }
        .resource-link:hover {
            text-decoration: underline;
        }
        .footerr {
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="container content">
    <div class="headerr text-center">
            <h1>Resumify's Ultimate Guide to Resume Writing</h1>
        </div>
        <div class="row">
            <!-- Introduction Section -->
            <div class="col-md-12 section">
                <div class="section-title">
                    <h2>Introduction</h2>
                </div>
                <p>Welcome to Resumify’s ultimate guide for creating an impressive resume! A well-crafted resume is essential for standing out in the job market. Follow these guidelines to build a resume that effectively showcases your skills, achievements, and experiences.</p>
                <p>Whether you are just starting your career or looking to update your existing resume, these tips will help you create a document that captures the attention of potential employers and sets you apart from the competition.</p>
            </div>

            <!-- Do's and Don'ts Section -->
            <div class="col-md-12 section">
                <div class="section-title">
                    <h2>Do’s and Don’t’s of Resume Writing</h2>
                </div>
                <div class="row">
                    <!-- Do's -->
                    <div class="col-md-6">
                        <div class="card do-dont-card">
                            <div class="card-header do-dont-card-header">
                                <h2 class="card-title">Do’s</h2>
                            </div>
                            <div class="card-body do-dont-card-body">
                                <ul class="do-dont-list">
                                    <li><strong>Use a clear and professional layout:</strong> Choose a clean, easy-to-read format that highlights your key achievements.</li>
                                    <li><strong>Highlight achievements:</strong> Focus on specific accomplishments and quantify your results to demonstrate impact.</li>
                                    <li><strong>Tailor your resume:</strong> Customize your resume for each job application to match the job description and requirements.</li>
                                    <li><strong>Include relevant keywords:</strong> Use industry-specific terms and phrases to pass through Applicant Tracking Systems (ATS).</li>
                                    <li><strong>Proofread for errors:</strong> Carefully review your resume for any spelling, grammatical, or formatting mistakes.</li>
                                    <li><strong>Use active language:</strong> Start bullet points with strong action verbs to convey your role effectively.</li>
                                    <li><strong>Keep it concise:</strong> Aim for one to two pages, focusing on relevant information that adds value to your application.</li>
                                    <li><strong>Include a summary statement:</strong> Write a brief summary at the top of your resume that highlights your key skills and experiences.</li>
                                    <li><strong>Highlight relevant skills:</strong> Emphasize skills that are directly related to the job you are applying for, including both technical and soft skills.</li>
                                    <li><strong>Use a consistent format:</strong> Maintain uniformity in fonts, colors, and headings to create a professional appearance.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Don'ts -->
                    <div class="col-md-6">
                        <div class="card do-dont-card">
                            <div class="card-header do-dont-card-header">
                                <h2 class="card-title">Don’t’s</h2>
                            </div>
                            <div class="card-body do-dont-card-body">
                                <ul class="do-dont-list">
                                    <li><strong>Don’t use an unprofessional email address:</strong> Ensure your contact information is professional and easy to contact.</li>
                                    <li><strong>Don’t include irrelevant information:</strong> Avoid adding personal details, hobbies, or outdated experiences that don't relate to the job.</li>
                                    <li><strong>Don’t use jargon:</strong> Avoid complex language or acronyms that might not be understood by all readers.</li>
                                    <li><strong>Don’t lie or exaggerate:</strong> Be honest about your skills, experience, and accomplishments to maintain credibility.</li>
                                    <li><strong>Don’t include salary expectations:</strong> Leave salary details out of your resume; focus on showcasing your qualifications.</li>
                                    <li><strong>Don’t use excessive formatting:</strong> Avoid using too many fonts, colors, or graphics that can make your resume look cluttered.</li>
                                    <li><strong>Don’t forget to update:</strong> Regularly update your resume to reflect your most recent experiences and achievements.</li>
                                    <li><strong>Don’t include long paragraphs:</strong> Use bullet points for readability and to highlight key information effectively.</li>
                                    <li><strong>Don’t use passive language:</strong> Avoid vague terms and focus on concrete actions and achievements.</li>
                                    <li><strong>Don’t neglect your professional summary:</strong> A missing or weak summary can reduce the effectiveness of your resume. Make sure it clearly outlines your career goals and highlights your key qualifications.</li>
                                    <li><strong>Don’t overuse personal pronouns:</strong> Maintain a professional tone and avoid using “I” frequently in your resume.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Examples Section -->
            <div class="col-md-12 section">
                <div class="section-title">
                    <h2>Examples of Effective vs. Ineffective Resume Entries</h2>
                </div>
                <div class="example">
                    <strong>Example of a Detailed Project Description:</strong>
                    <p>Led a cross-functional team in the development of a new CRM system. Managed the project from inception to completion, including defining project scope, developing a project plan, coordinating with stakeholders, and ensuring timely delivery. Successfully implemented the system, resulting in a 40% improvement in customer data management.</p>
                </div>
                <div class="example">
                    <strong>Example of a Generic Project Description:</strong>
                    <p>Worked on a CRM project.</p>
                </div>
                <div class="example">
                    <strong>Example of a Clear Skill Description:</strong>
                    <p>Proficient in Python and JavaScript with extensive experience in developing web applications and data analysis. Skilled in using frameworks such as Django and React to create dynamic and responsive user interfaces.</p>
                </div>
                <div class="example">
                    <strong>Example of a Vague Skill Description:</strong>
                    <p>Experienced in programming.</p>
                </div>
                <div class="example">
                    <strong>Example of a Specific Education Entry:</strong>
                    <p>Bachelor of Science in Computer Science, University of California, Los Angeles (UCLA), 2020. Relevant coursework: Data Structures, Algorithms, Web Development.</p>
                </div>
                <div class="example">
                    <strong>Example of a Generic Education Entry:</strong>
                    <p>Studied Computer Science at University.</p>
                </div>
                <div class="example">
                    <strong>Example of a Detailed Experience Entry:</strong>
                    <p>Software Developer, XYZ Corp (June 2021 - Present). Developed and maintained web applications using React and Node.js. Collaborated with a team of developers to design and implement new features based on user feedback and market trends.</p>
                </div>
                <div class="example">
                    <strong>Example of a Generic Experience Entry:</strong>
                    <p>Worked as a Software Developer.</p>
                </div>
            </div>

             <!-- Resources Section -->
            <div class="col-md-12 section">
                <div class="section-title">
                    <h2>Additional Resources</h2>
                </div>
                <p>For further reading and tools to assist with resume building, check out the following resources:</p>
                <div class="d-flex">
                    <a href="https://www.linkedin.com/help/linkedin/answer/4494" class="resource-link">LinkedIn Resume Tips</a>
                    <a href="https://www.indeed.com/career-advice/resume-samples" class="resource-link">Indeed Resume Samples</a>
                    <a href="https://www.thebalancecareers.com/how-to-write-a-resume-2063338" class="resource-link">The Balance Careers Resume Writing</a>
                </div>
            </div>
        </div>
    </div>


    <div class="footerr text-center mb-2">
    <p>&copy; 2024 Resumify. All rights reserved.</p>
</div


<?php
require './assets/includes/footer.php';
?>