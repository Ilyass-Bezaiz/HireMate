<?php

namespace App\DataProviders;

abstract class JobOfferDataProvider
{
    public static function data(): array
    {
        return array(
            array('id' => '1','user_id' => '31','title' => 'Software Engineer','description' => "<div>
            <h2>About Us:</h2>
            <p>
                Tesla, Inc. is a global leader in sustainable energy and electric vehicle manufacturing. Our mission is to
                accelerate the world's transition to sustainable energy. At Tesla, we're not just building cars; we're
                revolutionizing transportation and energy production. Join us in our quest to make the world a cleaner and
                more sustainable place through groundbreaking technology and innovation.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Design, develop, and implement cutting-edge software solutions for Tesla's electric vehicles and energy
                    products.</li>
                <li>Collaborate with interdisciplinary teams to define, architect, and deliver software features that push
                    the boundaries of technology.</li>
                <li>Debug, optimize, and maintain software to ensure the highest level of performance and user experience.</li>
                <li>Stay at the forefront of emerging technologies and contribute to the continuous improvement of Tesla's
                    software ecosystem.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Proficiency in Python, JavaScript, and C++.</li>
                <li>Experience with web development frameworks such as React and Django.</li>
                <li>Familiarity with embedded systems and real-time operating systems.</li>
                <li>Knowledge of AI and machine learning technologies.</li>
                <li>Solid understanding of the software development life cycle, best practices, and coding standards.</li>
                <li>Strong problem-solving and critical-thinking skills.</li>
                <li>Excellent communication and collaboration abilities.</li>
            </ul>
        </div>",'salary' => '100000.00','country_id' => '1','city_id' => '1','flexibility' => 'On site','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),


            array('id' => '2','user_id' => '33','title' => 'Data Scientist','description' => "<div>
            <h2>About Us:</h2>
            <p>
                Apple Inc. is a pioneer in technology and innovation, dedicated to creating products that enrich people's lives.
                From iPhones to MacBooks, Apple products are known for their exceptional quality and user experience. Join us in
                shaping the future of technology and making a positive impact on the world.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Apply advanced statistical and machine learning techniques to analyze large datasets and extract valuable insights.</li>
                <li>Collaborate with cross-functional teams to identify business problems and develop data-driven solutions.</li>
                <li>Build and deploy predictive models to enhance decision-making processes within the organization.</li>
                <li>Conduct exploratory data analysis to discover trends, patterns, and anomalies in diverse datasets.</li>
                <li>Stay current with industry trends and advancements in data science to continuously improve Apple's analytical capabilities.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Advanced proficiency in programming languages such as Python or R.</li>
                <li>Experience with data manipulation and analysis libraries such as Pandas and NumPy.</li>
                <li>Strong knowledge of statistical modeling, machine learning algorithms, and data visualization techniques.</li>
                <li>Ability to work with big data technologies and frameworks, such as Apache Spark.</li>
                <li>Excellent problem-solving skills and the ability to communicate complex findings to both technical and non-technical stakeholders.</li>
                <li>Demonstrated experience in applying data science methods to real-world business challenges.</li>
            </ul>
        </div>",'salary' => '120000.00','country_id' => '1','city_id' => '2','flexibility' => 'Hybrid','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),


            array('id' => '3','user_id' => '35','title' => 'UX/UI Designer','description' => "<div>
            <h2>About Us:</h2>
            <p>
                Microsoft is a global technology leader committed to empowering individuals and organizations to achieve more.
                From Windows to Azure, our products and services touch every aspect of modern computing. Join us in shaping the
                future of user experience and design excellence.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Collaborate with cross-functional teams to understand user requirements and design intuitive and visually appealing user interfaces.</li>
                <li>Create wireframes, prototypes, and user flows to effectively communicate design ideas and concepts.</li>
                <li>Conduct user research and usability testing to gather feedback and iterate on designs for optimal user experience.</li>
                <li>Stay current with industry trends and best practices in UX/UI design, and apply them to enhance Microsoft's product interfaces.</li>
                <li>Work closely with developers to ensure seamless implementation of design solutions.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Proven experience in UX/UI design for web and mobile applications.</li>
                <li>Proficiency in design tools such as Sketch, Figma, or Adobe Creative Suite.</li>
                <li>Strong understanding of user-centered design principles and interaction design.</li>
                <li>Excellent communication and collaboration skills, with the ability to present and justify design decisions.</li>
                <li>Experience with responsive design and a deep understanding of design systems.</li>
                <li>Ability to iterate quickly and work in an agile development environment.</li>
            </ul>
        </div>",'salary' => '90000.00','country_id' => '1','city_id' => '3','flexibility' => 'Remote','requestedContract' => 'Contract','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),


            array('id' => '4','user_id' => '37','title' => 'Marketing Specialist','description' => "<div>
            <h2>About Us:</h2>
            <p>
                Intel Inc. is a leading technology company that drives innovation in the computing and data industry. From processors
                to artificial intelligence solutions, Intel's products power the world's technology infrastructure. Join us in
                shaping the future of marketing and technology communication.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Develop and execute comprehensive marketing strategies to promote Intel's products and solutions.</li>
                <li>Create engaging content for various marketing channels, including digital, social media, and traditional platforms.</li>
                <li>Collaborate with product teams to understand key features and benefits, translating technical details into compelling marketing messages.</li>
                <li>Analyze market trends, competitor activities, and customer behavior to identify opportunities for marketing optimization.</li>
                <li>Plan and coordinate events, webinars, and product launches to enhance brand visibility and engagement.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Proven experience in marketing, with a focus on technology products or services.</li>
                <li>Excellent written and verbal communication skills.</li>
                <li>Strong understanding of digital marketing channels, including social media, content marketing, and email campaigns.</li>
                <li>Ability to work collaboratively in a cross-functional team environment.</li>
                <li>Analytical mindset with the ability to interpret data and make data-driven marketing decisions.</li>
                <li>Experience with marketing automation tools and customer relationship management (CRM) systems.</li>
            </ul>
        </div>",'salary' => '80000.00','country_id' => '1','city_id' => '4','flexibility' => 'Hybrid','requestedContract' => 'Part-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
        

            array('id' => '5','user_id' => '39','title' => 'Software Developer', 'description' => "<div>
            <h2>About Us:</h2>
            <p>
                Cisco is a global technology leader that designs and sells networking and communication solutions. With a focus on
                innovation and connectivity, Cisco is at the forefront of shaping the digital future. Join us in creating cutting-edge
                software solutions that power the world's networks and technologies.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Design, develop, test, and maintain high-quality software solutions for Cisco's networking products.</li>
                <li>Collaborate with cross-functional teams to define software requirements and specifications.</li>
                <li>Participate in code reviews, troubleshooting, and debugging to ensure optimal performance and reliability.</li>
                <li>Stay current with industry trends and emerging technologies to contribute to Cisco's innovation initiatives.</li>
                <li>Contribute to the full software development life cycle, from concept to deployment and maintenance.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Proficiency in programming languages such as C, C++, or Python.</li>
                <li>Experience with software development methodologies, tools, and best practices.</li>
                <li>Strong problem-solving and analytical skills.</li>
                <li>Knowledge of networking protocols and technologies.</li>
                <li>Ability to work collaboratively in an agile development environment.</li>
                <li>Excellent communication skills and the ability to work in a global team.</li>
            </ul>
        </div>",'salary' => '110000.00','country_id' => '1','city_id' => '5','flexibility' => 'Hybrid','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),


            array('id' => '6','user_id' => '41','title' => 'AI Research Scientist','description' => "<div>
            <h2>About Us:</h2>
            <p>
                Amazon Inc. is a global technology and e-commerce leader, known for innovation and customer-centricity. From cloud
                computing to artificial intelligence, Amazon is shaping the future of technology. Join us in advancing the state of
                the art in AI research and contributing to groundbreaking solutions that enhance customer experiences.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Conduct research in artificial intelligence, machine learning, and related fields to advance Amazon's technology capabilities.</li>
                <li>Design and implement novel algorithms and models to solve complex problems in areas such as natural language processing, computer vision, and reinforcement learning.</li>
                <li>Collaborate with cross-functional teams to integrate AI solutions into Amazon's products and services.</li>
                <li>Publish research findings in top-tier conferences and journals to contribute to the academic community.</li>
                <li>Stay abreast of the latest advancements in AI and identify opportunities for applying cutting-edge research to Amazon's business challenges.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Ph.D. in Computer Science, Artificial Intelligence, or a related field.</li>
                <li>Demonstrated expertise in machine learning, deep learning, and statistical modeling.</li>
                <li>Strong programming skills in languages such as Python, TensorFlow, and/or PyTorch.</li>
                <li>Experience with large-scale data analysis and distributed computing.</li>
                <li>Proven track record of publishing research papers in renowned conferences and journals.</li>
                <li>Excellent communication skills and the ability to collaborate in a dynamic and fast-paced environment.</li>
            </ul>
        </div>",'salary' => '130000.00','country_id' => '1','city_id' => '6','flexibility' => 'Remote','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),


            array('id' => '7','user_id' => '43','title' => 'Product Manager','description' => "<div>
            <h2>About Us:</h2>
            <p>
                Google is a global technology company that's synonymous with innovation and excellence. From search to cloud computing,
                Google's products impact billions of users worldwide. Join us in driving product strategy and delivering exceptional
                user experiences that shape the future of technology.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Lead the development and execution of product strategy, vision, and roadmap for Google's products.</li>
                <li>Collaborate with cross-functional teams, including engineering, design, and marketing, to deliver high-impact and user-centric products.</li>
                <li>Define and prioritize product features based on customer needs, market trends, and business goals.</li>
                <li>Analyze data, conduct market research, and gather customer feedback to inform product decisions and improvements.</li>
                <li>Manage the entire product life cycle from ideation to launch, ensuring successful delivery and adoption.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Bachelor's or Master's degree in Computer Science, Business, or a related field.</li>
                <li>Proven experience as a Product Manager with a successful track record of launching and managing products.</li>
                <li>Strong analytical and problem-solving skills, with the ability to make data-driven decisions.</li>
                <li>Excellent communication and interpersonal skills, with the ability to work collaboratively in a fast-paced environment.</li>
                <li>Understanding of technology trends and a passion for creating innovative solutions.</li>
                <li>Experience with agile development methodologies and project management tools.</li>
            </ul>
        </div>",'salary' => '95000.00','country_id' => '1','city_id' => '7','flexibility' => 'On site','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),


            array('id' => '8','user_id' => '45','title' => 'Software Engineer','description' => "<div>
            <h2>About Us:</h2>
            <p>
                Facebook is a leading social media platform that connects billions of people worldwide. Our mission is to give people
                the power to build community and bring the world closer together. Join us in creating cutting-edge software solutions
                that shape the future of social connectivity and technology.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Design and implement scalable and reliable software solutions for Facebook's products and services.</li>
                <li>Collaborate with cross-functional teams, including product managers and designers, to deliver impactful features.</li>
                <li>Contribute to the entire software development life cycle, from design to deployment and maintenance.</li>
                <li>Write clean, efficient, and maintainable code, and participate in code reviews to ensure code quality.</li>
                <li>Stay current with emerging technologies and industry trends to drive innovation within the company.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Bachelor's or Master's degree in Computer Science or a related field.</li>
                <li>Strong proficiency in programming languages such as Java, C++, or Python.</li>
                <li>Experience with web technologies, including HTML, CSS, and JavaScript.</li>
                <li>Knowledge of software development methodologies and best practices.</li>
                <li>Excellent problem-solving and analytical skills.</li>
                <li>Effective communication and collaboration abilities in a fast-paced environment.</li>
            </ul>
        </div>",'salary' => '105000.00','country_id' => '1','city_id' => '8','flexibility' => 'Hybrid','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),


            array('id' => '9','user_id' => '47','title' => 'Data Analyst','description' => "<div>
            <h2>About Us:</h2>
            <p>
                IBM is a global technology and consulting company that provides innovative solutions and services. From cloud computing
                to artificial intelligence, IBM is at the forefront of driving digital transformation. Join us in leveraging data to
                deliver insights that solve complex business challenges and enhance decision-making.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Collect, clean, and analyze large datasets to derive actionable insights and support business decisions.</li>
                <li>Develop and maintain data pipelines and processes for efficient data extraction, transformation, and loading (ETL).</li>
                <li>Create data visualizations and reports to communicate findings to both technical and non-technical stakeholders.</li>
                <li>Collaborate with business units to understand data requirements and provide analytical support for various projects.</li>
                <li>Contribute to the development and improvement of data analytics tools and methodologies.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Bachelor's or Master's degree in Data Science, Statistics, Computer Science, or a related field.</li>
                <li>Proven experience in data analysis, with proficiency in SQL, Python, or R.</li>
                <li>Strong knowledge of data visualization tools, such as Tableau or Power BI.</li>
                <li>Experience with statistical analysis and machine learning techniques.</li>
                <li>Ability to work with large and complex datasets in a variety of formats.</li>
                <li>Effective communication skills and the ability to translate data findings into actionable insights.</li>
            </ul>
        </div>",'salary' => '85000.00','country_id' => '1','city_id' => '9','flexibility' => 'Hybrid','requestedContract' => 'Contract','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),


            array('id' => '10','user_id' => '49','title' => 'UX/UI Designer','description' => "<div>
            <h2>About Us:</h2>
            <p>
                Oracle is a global technology company that provides a comprehensive suite of cloud applications, platform services, and
                engineered systems. Join us in designing intuitive and user-centered interfaces for Oracle's cutting-edge products,
                enhancing the user experience across the enterprise.
            </p>
        </div>
    
        <div>
            <h2>Responsibilities:</h2>
            <ul>
                <li>Collaborate with product managers and developers to understand user requirements and business goals.</li>
                <li>Create wireframes, prototypes, and high-fidelity designs for web and mobile applications.</li>
                <li>Conduct user research and usability testing to gather feedback and iterate on design solutions.</li>
                <li>Work closely with development teams to ensure the implementation of designs aligns with user experience goals.</li>
                <li>Contribute to the development and maintenance of design systems to ensure consistency across products.</li>
            </ul>
        </div>
    
        <div>
            <h2>Required Skills:</h2>
            <ul>
                <li>Bachelor's or Master's degree in Human-Computer Interaction, Design, or a related field.</li>
                <li>Proven experience as a UX/UI Designer with a strong portfolio showcasing design skills.</li>
                <li>Proficiency in design tools such as Sketch, Figma, or Adobe Creative Suite.</li>
                <li>Strong understanding of user-centered design principles and interaction design.</li>
                <li>Experience with responsive design and familiarity with web development technologies.</li>
                <li>Excellent communication and collaboration skills, with the ability to present and justify design decisions.</li>
            </ul>
        </div>",'salary' => '95000.00','country_id' => '1','city_id' => '10','flexibility' => 'On site','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43')
        
        );
    }
}
