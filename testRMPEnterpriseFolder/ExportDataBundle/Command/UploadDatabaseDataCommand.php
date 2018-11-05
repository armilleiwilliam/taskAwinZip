<?php
// src/MerchantTransactionsBundle/Command
namespace ExportDataBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ExportDataBundle\Entity\Course;
use ExportDataBundle\Entity\StudentAddress;
use ExportDataBundle\Entity\Student;

/**
 * Class UploadDatabaseDataCommand
 * @package ExportData\Command
 */
class UploadDatabaseDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('demo:uploadData')
            ->setDescription('Upload data');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get doctrine
        $em = $this->getContainer()->get('doctrine')->getManager();

        // list of courses to upload
        $courses = [
            ["course_name" => "Computer Science", "university" => "University of Nairobi"],
            ["course_name" => "Industrial Design", "university" => "Sheffield, University of"],
            ["course_name" => "Digital Forensics", "university" => "Deakin University"],
            ["course_name" => "Psychology", "university" => "University of Michigan"],
            ["course_name" => "Health Science", "university" => "University of Science and Technology Beijing"],
            ["course_name" => "Engineering", "university" => "Middlebury College"],
            ["course_name" => "Social Care", "university" => "Elmhurst College"],
            ["course_name" => "Maths", "university" => "Griffith University"],
            ["course_name" => "English Literature", "university" => "Sauder School of Business"],
            ["course_name" => "English Language", "university" => "University of Southern Maine"],
            ["course_name" => "Business", "university" => "Nanyang Academy of Fine Arts"],
            ["course_name" => "Law", "university" => "Aalto University"],
            ["course_name" => "European Law", "university" => "Jonkoping University College"],
            ["course_name" => "Business Information Systems", "university" => "Florida International University"],
            ["course_name" => "Software Engineering", "university" => "Lebanese American University"],
            ["course_name" => "Product Design", "university" => "Imperial College London"],
            ["course_name" => "Computing", "university" => "Jiangxi University of Finance and Economics"],
            ["course_name" => "Advertising", "university" => "Regensburg University"],
            ["course_name" => "Banking - Commercial", "university" => "New York University"],
            ["course_name" => "Art", "university" => "Ealing & West London College"],
            ["course_name" => "Banking - Investment", "university" => "University of Witten/Herdecke"],
            ["course_name" => "Auditing/Tax", "university" => "Hankuk University of Foreign Studies"],
            ["course_name" => "E-Business", "university" => "Warburg Institute"],
            ["course_name" => "Arts/Entertainment/Media", "university" => "Liverpool John Moores University"],
            ["course_name" => "Automotive", "university" => "Erasmus University Rotterdam"],
            ["course_name" => "Accountancy", "university" => "University of South Australia"],
            ["course_name" => "Design", "university" => "University of Groningen"],
            ["course_name" => "Msc Construction Project Management", "university" => "Drake University"],
            ["course_name" => "Music", "university" => "University of Szeged"],
            ["course_name" => "Business Management", "university" => "Southampton, University of"],
            [
                "course_name" => "Politics And Eastern European Studies With A Year Abroad",
                "university" => "Abingdon and Witney College"
            ],
            ["course_name" => "Politics And English", "university" => "University of Tsukuba"],
            ["course_name" => "International Politics", "university" => "Newcastle University"],
            ["course_name" => "IMML German", "university" => "Aalborg University"],
            ["course_name" => "BA Modern Languages With Business Management", "university" => "Chungang University"],
            ["course_name" => "BEng Mechanical Engineering", "university" => "Padjadjaran University"],
            ["course_name" => "Business And Management", "university" => "PACE University"],
            ["course_name" => "Business And Management (Accounting)", "university" => "Humboldt University"],
            ["course_name" => "History", "university" => "Chulalongkorn University"],
            ["course_name" => "Geography", "university" => "University of the Philippines - Los Banos"],
            ["course_name" => "PPS", "university" => "Sacred Heart University"],
            ["course_name" => "Environment, Society And Development", "university" => "Lodz University"],
            ["course_name" => "Sport Exercise Science", "university" => "National Sun Yat-sen University"],
            ["course_name" => "Forensic Science", "university" => "Morehouse College"],
            ["course_name" => "Criminology And Social Policy", "university" => "Dublin City University"],
            ["course_name" => "Commerce", "university" => "Columbia Business School"],
            ["course_name" => "Bar Professional Training Course", "university" => "Ecole Centrale de Paris"],
            ["course_name" => "BPTC", "university" => "University of Maine"],
            ["course_name" => "Creative Writing", "university" => "Kasetsart University"],
            ["course_name" => "Forensic Science With Crimonology", "university" => "Glasgow School of Art"],
            ["course_name" => "Ll.b Law With Criminology", "university" => "Molloy College"],
            [
                "course_name" => "Global Crime, Justice, Security",
                "university" => "Swiss School of International Banking"
            ],
            ["course_name" => "Linguistics", "university" => "Cooper Union"],
            ["course_name" => "LLB LAW", "university" => "Obafemi Awololo University"],
            ["course_name" => "History And Politics", "university" => "Turku University"],
            ["course_name" => "LLB", "university" => "Management Development Institute"],
            ["course_name" => "BA, Hons Accounting And Finance", "university" => "Ochanomizu Univ"],
            ["course_name" => "Accountancy & Business Law", "university" => "Winthrop University"],
            ["course_name" => "Human Resource Management", "university" => "ENSAE"],
            ["course_name" => "Accounting And Financial Management", "university" => "University of Waterloo"],
            ["course_name" => "Biomedical Science", "university" => "ESSEC Business School (Paris)"],
            [
                "course_name" => "French And History",
                "university" => "Graduate University of Chinese Academy of Sciences"
            ],
            ["course_name" => "BBA Management", "university" => "Barnet College"],
            [
                "course_name" => "German And Management",
                "university" => "Ecole Nationale Superieure de Techniques Avancees"
            ],
            ["course_name" => "Biological Sciences", "university" => "University of KwaZulu Natal"],
            ["course_name" => "Law LLB", "university" => "The Grimsby Institute of Further & Higher Education"],
            ["course_name" => "History (BA Hons)", "university" => "Flinders University"],
            ["course_name" => "Economic And Social History", "university" => "Universidad Internacional"],
            ["course_name" => "Process Design Engineering", "university" => "Villanova University"],
            ["course_name" => "LPC", "university" => "Universidad Adolfo Ibanez (Creo que es Chilena tambien)"],
            ["course_name" => "Medicine", "university" => "University of St. La Salle - Bacolod"],
            [
                "course_name" => "Human Resource Management And Organisational Analysis",
                "university" => "Universita degli Studi di Venezia"
            ],
            ["course_name" => "BA", "university" => "University of Bonn"],
            ["course_name" => "MBA", "university" => "SUNY Fredonia"],
            ["course_name" => "BSc Economics", "university" => "Universidad Ramon Llull"],
            ["course_name" => "Economics And Politics", "university" => "Universita Cattolica del Sacro Cuore"],
            ["course_name" => "Geography And Geology", "university" => "Delhi University"],
            ["course_name" => "MSc Digital Anthropology", "university" => "The State University of New Jersey"],
            ["course_name" => "Neuroscience", "university" => "Hobart and William Smith"],
            ["course_name" => "International Relations", "university" => "Ealing & West London College"],
            [
                "course_name" => "LLM In International Business Law",
                "university" => "Institut Superieur des Affaires (ISA)"
            ],
            ["course_name" => "Modern Languages", "university" => "University of Newcastle"],
            ["course_name" => "Politics", "university" => "American University of Kuwait"],
            ["course_name" => "Environmental Science", "university" => "Duisenberg School of Finance"],
            ["course_name" => "LLB Law With European Law", "university" => "Aberdeen, University of"],
            ["course_name" => "Mathematics", "university" => "Royal Academy of Music"],
            ["course_name" => "Natural Sciences", "university" => "DIW Berlin"],
            ["course_name" => "Law With Criminology", "university" => "Universidad Panamericana"],
            ["course_name" => "Open Degree", "university" => "Parahyangan University"],
            [
                "course_name" => "Bachelor Of Computer Science Engineering",
                "university" => "Malaysia University of Science and Technology"
            ],
            ["course_name" => "Philosophy", "university" => "Bishop Grosseteste College"],
            ["course_name" => "PPE", "university" => "Scuola Normale Superiore (Pisa)"],
            ["course_name" => "Applied Accounting", "university" => "Friedrich Alexander University"],
            ["course_name" => "LAW AND INTERNATIONAL RELATIONS", "university" => "BPP"],
            [
                "course_name" => "Social Work",
                "university" => "LUISS (Libera Universita Internazionale degli Studi Sociali)"
            ],
            ["course_name" => "HR", "university" => "National Tsing-Hua University"],
            [
                "course_name" => "Wildlife Conservation With Zoo Biology",
                "university" => "University of San Jose - Recoletos"
            ],
            ["course_name" => "Chinese", "university" => "University of Connecticut"],
            ["course_name" => "Maths And Accounting", "university" => "Asia Pacific College"],
            ["course_name" => "Business And HR Management", "university" => "Miriam College"],
            ["course_name" => "Law And French", "university" => "University of Central Florida"],
            ["course_name" => "Business Analysis And Consulting", "university" => "Scuola Superiore S.Anna (Pisa)"],
            ["course_name" => "Health And Social Care", "university" => "UHI Millennium Institute"],
            ["course_name" => "Social. Science", "university" => "Moscow State Technical University"],
            [
                "course_name" => "International Commercial & Maritime Law",
                "university" => "Bandung Institute of Technology"
            ],
            ["course_name" => "BSc Computer Networks", "university" => "Coastal Carolina University"],
            ["course_name" => "Historical Archaeology", "university" => "Shanghai Maritime University"],
            ["course_name" => "English Literature And Politics", "university" => "Creighton University"],
            ["course_name" => "Chemistry", "university" => "Universita degli Studi di Roma/La Sapienza"],
            ["course_name" => "Business/Management", "university" => "Queen Mary, University of London"],
            ["course_name" => "Other", "university" => "Wilmington College"],
            ["course_name" => "Biology", "university" => "UHI Millennium Institute"],
            ["course_name" => "Economics", "university" => "Molloy College"],
            ["course_name" => "Languages", "university" => "Camberwell College of Arts"],
            ["course_name" => "English", "university" => "University of Nurtingen"],
            ["course_name" => "Physics", "university" => "Indian Institute of Management, Indore"],
            ["course_name" => "Sciences", "university" => "Richmond School of Business"],
            ["course_name" => "Classics", "university" => "College of the Holy Cross"],
            ["course_name" => "Information Technology", "university" => "University of Washington"],
            ["course_name" => "Education/Teaching", "university" => "Sabhal Mor Ostaig"],
            ["course_name" => "Electronic And Electrical Engineering", "university" => "Universidad Francisco Gavidia"],
            ["course_name" => "Civil Engineering", "university" => "Universita degli Studi di Firenze"],
            ["course_name" => "Agriculture", "university" => "Moscow University of People's Friendship"],
            ["course_name" => "Management Consultancy", "university" => "Clark Atlanta University"],
            ["course_name" => "Human Resources", "university" => "University of the Philippines - Pampanga"],
            ["course_name" => "Financial Management", "university" => "University of Limerick"],
            ["course_name" => "Marketing", "university" => "Scarborough Campus, University of Hull"],
            ["course_name" => "Mathematics/Statistics", "university" => "Abertay, University of"],
            ["course_name" => "Chemical Engineering", "university" => "Universita degli Studi di Padova"],
            ["course_name" => "Banking/Finance", "university" => "Winchester, University of"],
            ["course_name" => "Sport/Sports Management", "university" => "Schiller University"],
            [
                "course_name" => "Business Analytics",
                "university" => "College of Staten Island - Macaulay Honors College"
            ],
            ["course_name" => "Retail/Merchandising", "university" => "New York University"],
            ["course_name" => "Business Intelligence/Market Research", "university" => "St. Xavier's College"],
            ["course_name" => "Actuarial", "university" => "St. John's University"],
            ["course_name" => "Material And Mineral Engineering", "university" => "ESB-Reutlingen"],
            ["course_name" => "Computer And Systems Engineering", "university" => "City University of Hong Kong"],
            ["course_name" => "Legal/Law", "university" => "Moscow State Technical University"],
            ["course_name" => "Pharmaceutical", "university" => "US Military Acedemy"],
            ["course_name" => "Environmental", "university" => "Dundee College"],
            ["course_name" => "Science/Research", "university" => "Royal Veterinary College"],
            ["course_name" => "Food And Drink", "university" => "Universita Cattolica di Milano"],
            ["course_name" => "Mechanical Engineering", "university" => "Doncaster College"],
            ["course_name" => "Architecture", "university" => "Singapore Polytechnic"],
            ["course_name" => "Charity/Non Profit", "university" => "University of the Witwatersrand"],
            ["course_name" => "Aeronautical Engineering", "university" => "University of Western Ontario"],
            ["course_name" => "Medical/Health", "university" => "Chuo University"],
            ["course_name" => "Administration/Secretarial", "university" => "Le Moyne College"],
            [
                "course_name" => "Public Sector/Governmental",
                "university" => "European Business School (Oestrich-Winkel)"
            ],
            ["course_name" => "Anthropology", "university" => "Lebanese American University"],
            ["course_name" => "Property/Real Estate", "university" => "Brooklyn College"],
            ["course_name" => "Banking - Retail", "university" => "Hebrew University"],
            ["course_name" => "Sociology", "university" => "University of Southern Maine"],
            ["course_name" => "Mathematical & Computer Sciences", "university" => "XLRI, Jamshedpur"],
            ["course_name" => "Business & Management", "university" => "East China Normal University"],
            ["course_name" => "Arts & Humanities", "university" => "RCN Institute"],
            ["course_name" => "Physical Earth & Biological Sciences", "university" => "University of Calgary"],
            ["course_name" => "Social Sciences Incl Human Geography", "university" => "European Business School"],
            ["course_name" => "Accountancy Banking & Finance", "university" => "University of Pennsylvania"],
            ["course_name" => "BA(Hons) Politics And Modern History", "university" => "Askham Bryan College"],
            ["course_name" => "Law LLB (Hons)", "university" => "University of Phoenix"],
            ["course_name" => "LL.B (Hons)", "university" => "Barking College"],
            ["course_name" => "LLB Law With Politics", "university" => "Blackburn College"],
            [
                "course_name" => "(BA) English Literature And American Studies",
                "university" => "Birmingham, University of"
            ],
            ["course_name" => "Law With Politics LLB", "university" => "Mahidol University"],
            ["course_name" => "International Business, Finance & Economics", "university" => "La Trobe University"],
            ["course_name" => "MSc International Politics", "university" => "University of the Philippines - Diliman"],
            ["course_name" => "Business And Law", "university" => "ESCP Europe (London)"],
            [
                "course_name" => "European Studies (Politics, History, French, Italian)",
                "university" => "Xi'an Jiaotong university"
            ],
            ["course_name" => "LLM Laws", "university" => "SKEMA Business School"],
            ["course_name" => "Business & Law", "university" => "Blackburn College"],
            ["course_name" => "LL.M", "university" => "University of Koln"],
            ["course_name" => "German And History", "university" => "Nottingham Trent University"],
            [
                "course_name" => "LLM In International Finance And Banking Law",
                "university" => "St Andrews, University of"
            ],
            ["course_name" => "Comparative Literature", "university" => "Hunan University"],
            ["course_name" => "LLM", "university" => "Ghent University"],
            ["course_name" => "Master Of Law", "university" => "Arizona State University"],
            ["course_name" => "MSc Social Cognition", "university" => "XLRI, Jamshedpur"],
            ["course_name" => "English Law And German Law", "university" => "Stirling, University of"],
            ["course_name" => "English Law & Hong Kong Law", "university" => "Edinburgh, University of"],
            ["course_name" => "LLB 2014", "university" => "Edinburgh, University of"],
            ["course_name" => "Law LLB 2015", "university" => "Bradford, University of"],
            ["course_name" => "Politics, Philosophy And Law LLB", "university" => "Leuphana University"],
            ["course_name" => "LLM In International Commercial Law", "university" => "UAM University"],
            [
                "course_name" => "BA Management And Leadership With European Study",
                "university" => "Polytechnic di Torino"
            ],
            ["course_name" => "Philosophy, Politics And Economics", "university" => "Trinity College Carmarthen"],
            ["course_name" => "LL.B Law", "university" => "Clark Atlanta University"],
            ["course_name" => "European Law (Maitrise)", "university" => "Providence College"],
            ["course_name" => "LLB (European) Law", "university" => "City of Sunderland College"],
            ["course_name" => "BA Economics", "university" => "University College Birmingham"],
            ["course_name" => "Anthropology And Law", "university" => "Xidian University"],
            ["course_name" => "LLM In Banking And Finance", "university" => "Cardiff University"],
            ["course_name" => "BSc Philosophy, Logic And Scientific Method", "university" => "ESCP Europe (London)"],
            ["course_name" => "LLM Tax Law", "university" => "UAM University"],
            ["course_name" => "Law (3yr LLB)", "university" => "Koc University"],
            ["course_name" => "Law And Business", "university" => "Brighton College of Technology"],
            [
                "course_name" => "Law And European Law (Qualifying Year Abroad In English)",
                "university" => "Saint Mary's College of Meycauayan"
            ],
            ["course_name" => "Law (3 Years)", "university" => "Jacksonville University"],
            ["course_name" => "Law (M100)", "university" => "Hofstra University"],
            ["course_name" => "Law And Business Studies", "university" => "Beijing Institute of Technology"],
        ];

        // loop courses
        if ($courses && count($courses) > 0) {
            foreach ($courses as $course) {

                // new object
                $newCourse = new Course();

                // set values
                $newCourse->setCourseName($course["course_name"]);
                $newCourse->setUniversity($course["university"]);

                // persist
                $em->persist($newCourse);
                $em->flush();
            }
        } else {
            $output->writeln("No course to upload.");
        }

        $addresses = [
            [
                "city" => "Lake Maribelmouth",
                "postcode" => "70501-9233",
                "houseNo" => 184,
                "line_1" => "Jessyca Shoal",
                "line_2" => "Aniya Walks"
            ],
            [
                "city" => "Beattyside",
                "postcode" => "45825-7305",
                "houseNo" => 182,
                "line_1" => "Kling Ramp",
                "line_2" => "Quitzon Trail"
            ],
            [
                "city" => "Rashadmouth",
                "postcode" => "67079",
                "houseNo" => 950,
                "line_1" => "Arianna Crossroad",
                "line_2" => "Hackett Ford"
            ],
            [
                "city" => "West Amieland",
                "postcode" => "48841-7603",
                "houseNo" => 166,
                "line_1" => "Donny Center",
                "line_2" => "Marquis Ferry"
            ],
            [
                "city" => "New Marianna",
                "postcode" => "23274",
                "houseNo" => 926,
                "line_1" => "Zulauf Mission",
                "line_2" => "Mike Freeway"
            ],
            [
                "city" => "West Hallestad",
                "postcode" => "29920",
                "houseNo" => 576,
                "line_1" => "Terry Gardens",
                "line_2" => "Berniece Light"
            ],
            [
                "city" => "Bernieburgh",
                "postcode" => "79660",
                "houseNo" => 7,
                "line_1" => "Lorna Stream",
                "line_2" => "Bechtelar Locks"
            ],
            [
                "city" => "North Dandreside",
                "postcode" => "51003",
                "houseNo" => 474,
                "line_1" => "Reichel Forges",
                "line_2" => "Dennis River"
            ],
            [
                "city" => "East Isai",
                "postcode" => "45781-7986",
                "houseNo" => 287,
                "line_1" => "Uriah Brook",
                "line_2" => "Maximilian Extensions"
            ],
            [
                "city" => "Earlinehaven",
                "postcode" => "15635-1486",
                "houseNo" => 476,
                "line_1" => "Zemlak Ville",
                "line_2" => "Stamm Motorway"
            ],
            [
                "city" => "South Orlando",
                "postcode" => "59708-3336",
                "houseNo" => 664,
                "line_1" => "Harvey Falls",
                "line_2" => "Gutkowski Summit"
            ],
            [
                "city" => "Torptown",
                "postcode" => "73423",
                "houseNo" => 423,
                "line_1" => "Wintheiser Ford",
                "line_2" => "Little Ville"
            ],
            [
                "city" => "West Clarabelle",
                "postcode" => "16262-5611",
                "houseNo" => 210,
                "line_1" => "Charles Springs",
                "line_2" => "Hane Villages"
            ],
            [
                "city" => "Swaniawskifurt",
                "postcode" => "52963",
                "houseNo" => 566,
                "line_1" => "Lacy Square",
                "line_2" => "Goyette Brook"
            ],
            [
                "city" => "Lake Ginahaven",
                "postcode" => "89902",
                "houseNo" => 281,
                "line_1" => "Yost Rapid",
                "line_2" => "Lourdes Island"
            ],
            [
                "city" => "New Calistabury",
                "postcode" => "23485",
                "houseNo" => 990,
                "line_1" => "Shields Station",
                "line_2" => "Rodriguez Junction"
            ],
            [
                "city" => "North Annamaebury",
                "postcode" => "23935-3072",
                "houseNo" => 975,
                "line_1" => "Cierra Drive",
                "line_2" => "Myrtie Ports"
            ],
            [
                "city" => "Port Adamland",
                "postcode" => "67091-2083",
                "houseNo" => 535,
                "line_1" => "Santino Inlet",
                "line_2" => "Goodwin Junctions"
            ],
            [
                "city" => "North Raphael",
                "postcode" => "10455-1250",
                "houseNo" => 472,
                "line_1" => "Nicolas Shoals",
                "line_2" => "Isom Centers"
            ],
            [
                "city" => "North Anissa",
                "postcode" => "38374-2978",
                "houseNo" => 192,
                "line_1" => "Aida Roads",
                "line_2" => "Gulgowski Pines"
            ],
            [
                "city" => "Macejkovicberg",
                "postcode" => "70395",
                "houseNo" => 257,
                "line_1" => "Monique Views",
                "line_2" => "Vandervort Way"
            ],
            [
                "city" => "East Stephenmouth",
                "postcode" => "61523-2821",
                "houseNo" => 624,
                "line_1" => "Gerlach Locks",
                "line_2" => "Erdman Drive"
            ],
            [
                "city" => "Lake Maurine",
                "postcode" => "05886-1163",
                "houseNo" => 739,
                "line_1" => "Newton Hill",
                "line_2" => "Sanford Ferry"
            ],
            [
                "city" => "East Oceaneview",
                "postcode" => "53928",
                "houseNo" => 960,
                "line_1" => "Cassin Lakes",
                "line_2" => "Mireya Run"
            ],
            [
                "city" => "Schmelerburgh",
                "postcode" => "49822-0920",
                "houseNo" => 125,
                "line_1" => "Otis Station",
                "line_2" => "Albertha Walks"
            ],
            [
                "city" => "Port Alfonzostad",
                "postcode" => "03638",
                "houseNo" => 713,
                "line_1" => "Hand Lakes",
                "line_2" => "Cordell Burg"
            ],
            [
                "city" => "Port Chandler",
                "postcode" => "05286-3097",
                "houseNo" => 257,
                "line_1" => "Mohammad Cove",
                "line_2" => "Sanford Streets"
            ],
            [
                "city" => "Brooksfurt",
                "postcode" => "73403",
                "houseNo" => 770,
                "line_1" => "Lind Forge",
                "line_2" => "Ziemann Stream"
            ],
            [
                "city" => "Websterchester",
                "postcode" => "91794-0529",
                "houseNo" => 787,
                "line_1" => "Halie Hill",
                "line_2" => "Bertram Harbors"
            ],
            [
                "city" => "South Erikshire",
                "postcode" => "13115-1292",
                "houseNo" => 975,
                "line_1" => "Stehr Squares",
                "line_2" => "Josie Turnpike"
            ],
            [
                "city" => "Jacobsport",
                "postcode" => "65470-8982",
                "houseNo" => 375,
                "line_1" => "Williamson Valleys",
                "line_2" => "Daren Ranch"
            ],
            [
                "city" => "North Randall",
                "postcode" => "76963",
                "houseNo" => 623,
                "line_1" => "Velma Creek",
                "line_2" => "Samantha Mews"
            ],
            [
                "city" => "West Lavadabury",
                "postcode" => "30695",
                "houseNo" => 171,
                "line_1" => "Gonzalo Prairie",
                "line_2" => "Marks Groves"
            ],
            [
                "city" => "South Ezequiel",
                "postcode" => "59618",
                "houseNo" => 747,
                "line_1" => "Shields Plaza",
                "line_2" => "Medhurst Plaza"
            ],
            [
                "city" => "Ullrichhaven",
                "postcode" => "32680",
                "houseNo" => 262,
                "line_1" => "Liliana Wall",
                "line_2" => "Sabrina Mountain"
            ],
            [
                "city" => "South Garthburgh",
                "postcode" => "65687",
                "houseNo" => 773,
                "line_1" => "Jake Row",
                "line_2" => "Magdalen Square"
            ],
            [
                "city" => "D'Amoreberg",
                "postcode" => "64042-7915",
                "houseNo" => 529,
                "line_1" => "Streich Park",
                "line_2" => "Parker Mount"
            ],
            [
                "city" => "Rempelview",
                "postcode" => "57378-2241",
                "houseNo" => 309,
                "line_1" => "Zoila Vista",
                "line_2" => "Deckow Highway"
            ],
            [
                "city" => "North Dashawn",
                "postcode" => "59069",
                "houseNo" => 970,
                "line_1" => "Kohler Summit",
                "line_2" => "Turner Forge"
            ],
            [
                "city" => "New Arch",
                "postcode" => "40444-3540",
                "houseNo" => 487,
                "line_1" => "Johnny Radial",
                "line_2" => "Jeffery Heights"
            ],
            [
                "city" => "South Domenicafort",
                "postcode" => "41969",
                "houseNo" => 900,
                "line_1" => "Camylle Fall",
                "line_2" => "Medhurst Circle"
            ],
            [
                "city" => "Breitenbergberg",
                "postcode" => "39372",
                "houseNo" => 286,
                "line_1" => "Taurean Mountain",
                "line_2" => "Wintheiser Green"
            ],
            [
                "city" => "West Heatherfort",
                "postcode" => "89548-6478",
                "houseNo" => 750,
                "line_1" => "562 Mills Unions",
                "line_2" => "887 Shanahan Branch"
            ],
            [
                "city" => "South Chyna",
                "postcode" => "68822",
                "houseNo" => 678,
                "line_1" => "Olson Inlet",
                "line_2" => "Thiel Locks"
            ],
            [
                "city" => "New Dejuan",
                "postcode" => "44003",
                "houseNo" => 536,
                "line_1" => "Schumm Ford",
                "line_2" => "Carter Corners"
            ],
            [
                "city" => "Binston",
                "postcode" => "20086-3486",
                "houseNo" => 48,
                "line_1" => "Elissa Ports",
                "line_2" => "Orn Landing"
            ],
            [
                "city" => "New Davetown",
                "postcode" => "60928-5635",
                "houseNo" => 335,
                "line_1" => "Kirlin Pass",
                "line_2" => "Effertz Route"
            ],
            [
                "city" => "Port Gunnar",
                "postcode" => "88815",
                "houseNo" => 956,
                "line_1" => "Aurelio Haven",
                "line_2" => "Hammes Drive"
            ],
            [
                "city" => "Katarinaville",
                "postcode" => "22457-2256",
                "houseNo" => 541,
                "line_1" => "75576 Dannie Islands",
                "line_2" => "98367 Rachel Ports"
            ],
            [
                "city" => "South Frederiqueport",
                "postcode" => "65579-6067",
                "houseNo" => 925,
                "line_1" => "959 Schuppe Valley",
                "line_2" => "00902 Monahan Springs"
            ],
            [
                "city" => "Port Cecilview",
                "postcode" => "74166",
                "houseNo" => 152,
                "line_1" => "Antonette Mountain",
                "line_2" => "Cronin Summit"
            ],
            [
                "city" => "Deronville",
                "postcode" => "16789-2279",
                "houseNo" => 598,
                "line_1" => "Nola Bridge",
                "line_2" => "Bianka Harbor"
            ],
            [
                "city" => "Lake Mervin",
                "postcode" => "20854-6183",
                "houseNo" => 757,
                "line_1" => "58901 Ledner Courts",
                "line_2" => "8553 Wuckert Lock"
            ],
            [
                "city" => "Botsfordton",
                "postcode" => "61325-3623",
                "houseNo" => 584,
                "line_1" => "Swift Stream",
                "line_2" => "Javon Canyon"
            ],
            [
                "city" => "Ettieton",
                "postcode" => "85263-5673",
                "houseNo" => 385,
                "line_1" => "Kip Parkway",
                "line_2" => "Dayton Orchard"
            ],
            [
                "city" => "New Albina",
                "postcode" => "57328",
                "houseNo" => 145,
                "line_1" => "Casandra Trail",
                "line_2" => "Morissette Cliffs"
            ],
            [
                "city" => "Mossiefurt",
                "postcode" => "36847-5080",
                "houseNo" => 553,
                "line_1" => "Sipes Crescent",
                "line_2" => "Kayli Meadows"
            ],
            [
                "city" => "Port Jennifer",
                "postcode" => "06490-1906",
                "houseNo" => 744,
                "line_1" => "Eliezer Forks",
                "line_2" => "Amelia Landing"
            ],
            [
                "city" => "Josiannechester",
                "postcode" => "71989-0153",
                "houseNo" => 708,
                "line_1" => "Bradley Center",
                "line_2" => "Antonette Field"
            ],
            [
                "city" => "West Krisport",
                "postcode" => "09798",
                "houseNo" => 444,
                "line_1" => "Josephine Rest",
                "line_2" => "Myles Key"
            ],
            [
                "city" => "Larsontown",
                "postcode" => "57283-9246",
                "houseNo" => 153,
                "line_1" => "Korey Manor",
                "line_2" => "Carlotta Underpass"
            ],
            [
                "city" => "South Efrain",
                "postcode" => "75271",
                "houseNo" => 270,
                "line_1" => "Dolores Loaf",
                "line_2" => "West Flats"
            ],
            [
                "city" => "Devinfurt",
                "postcode" => "12853-7190",
                "houseNo" => 662,
                "line_1" => "Edgardo Center",
                "line_2" => "Turcotte Islands"
            ],
            [
                "city" => "Framiton",
                "postcode" => "42965",
                "houseNo" => 524,
                "line_1" => "Roxanne Square",
                "line_2" => "Edyth Plains"
            ],
            [
                "city" => "Port Havenmouth",
                "postcode" => "98723-2113",
                "houseNo" => 342,
                "line_1" => "Sam Falls",
                "line_2" => "Wintheiser Lakes"
            ],
            [
                "city" => "Port Daniellechester",
                "postcode" => "15208-2715",
                "houseNo" => 168,
                "line_1" => "845 Simonis Branch",
                "line_2" => "1907 Ozella Spring"
            ],
            [
                "city" => "Michealfort",
                "postcode" => "77651",
                "houseNo" => 426,
                "line_1" => "Ally Views",
                "line_2" => "Eladio Pike"
            ],
            [
                "city" => "West Guidotown",
                "postcode" => "49799-1681",
                "houseNo" => 693,
                "line_1" => "Alene Unions",
                "line_2" => "Kirk Dam"
            ],
            [
                "city" => "Port Pearlton",
                "postcode" => "49087-1056",
                "houseNo" => 199,
                "line_1" => "Vandervort Bypass",
                "line_2" => "Reynolds Shoals"
            ],
            [
                "city" => "North Lexushaven",
                "postcode" => "92272",
                "houseNo" => 3,
                "line_1" => "Jast Manors",
                "line_2" => "Aliya Drive"
            ],
            [
                "city" => "Fadelborough",
                "postcode" => "40452",
                "houseNo" => 354,
                "line_1" => "Camylle Cliff",
                "line_2" => "Dolly Hills"
            ],
            [
                "city" => "West Janetberg",
                "postcode" => "54465",
                "houseNo" => 931,
                "line_1" => "Heaney Fork",
                "line_2" => "Lois Prairie"
            ],
            [
                "city" => "Stephanside",
                "postcode" => "65044-0521",
                "houseNo" => 333,
                "line_1" => "Halvorson Stravenue",
                "line_2" => "Abbott Grove"
            ],
            [
                "city" => "East Jadynmouth",
                "postcode" => "76780",
                "houseNo" => 89,
                "line_1" => "Cordelia Place",
                "line_2" => "Dustin Expressway"
            ],
            [
                "city" => "Eunicefurt",
                "postcode" => "50683",
                "houseNo" => 419,
                "line_1" => "Mikayla Crescent",
                "line_2" => "Carli Grove"
            ],
            [
                "city" => "North Martaberg",
                "postcode" => "22433-4951",
                "houseNo" => 231,
                "line_1" => "Ruecker Mews",
                "line_2" => "Britney Hill"
            ],
            [
                "city" => "Tremblaychester",
                "postcode" => "83251",
                "houseNo" => 266,
                "line_1" => "Pfeffer Ridge",
                "line_2" => "Devin Brook"
            ],
            [
                "city" => "North Adahville",
                "postcode" => "48907-7261",
                "houseNo" => 220,
                "line_1" => "Dan Light",
                "line_2" => "Zulauf Village"
            ],
            [
                "city" => "Port Gregtown",
                "postcode" => "56380-3457",
                "houseNo" => 871,
                "line_1" => "Fritsch Hills",
                "line_2" => "Wunsch Summit"
            ],
            [
                "city" => "New Roslynport",
                "postcode" => "30775",
                "houseNo" => 667,
                "line_1" => "O'Conner Junctions",
                "line_2" => "Leo Parks"
            ],
            [
                "city" => "South Frances",
                "postcode" => "24490-3361",
                "houseNo" => 266,
                "line_1" => "Winona Lock",
                "line_2" => "Stiedemann Centers"
            ],
            [
                "city" => "Port Kipmouth",
                "postcode" => "87322-3717",
                "houseNo" => 296,
                "line_1" => "Hettinger Garden",
                "line_2" => "Favian Locks"
            ],
            [
                "city" => "Bartellchester",
                "postcode" => "35701-0921",
                "houseNo" => 431,
                "line_1" => "Kihn View",
                "line_2" => "Libbie Street"
            ],
            [
                "city" => "East Wendyberg",
                "postcode" => "22643-4367",
                "houseNo" => 339,
                "line_1" => "Kling Rue",
                "line_2" => "Reinger Stream"
            ],
            [
                "city" => "Lake Salvador",
                "postcode" => "88879",
                "houseNo" => 978,
                "line_1" => "Zulauf Villages",
                "line_2" => "Bashirian Parks"
            ],
            [
                "city" => "Port Vincenzoville",
                "postcode" => "58918-7695",
                "houseNo" => 175,
                "line_1" => "Collier Spur",
                "line_2" => "Demarco Fork"
            ],
            [
                "city" => "Olehaven",
                "postcode" => "84813",
                "houseNo" => 166,
                "line_1" => "8489 Herman Junction",
                "line_2" => "19889 Karli Mountains"
            ],
            [
                "city" => "Darbyside",
                "postcode" => "36013",
                "houseNo" => 145,
                "line_1" => "Adelbert Canyon",
                "line_2" => "Joelle Ford"
            ],
            [
                "city" => "Alvertamouth",
                "postcode" => "18292-9249",
                "houseNo" => 227,
                "line_1" => "Hamill Pass",
                "line_2" => "Funk Skyway"
            ]
        ];

        // loop addresses
        if ($addresses && count($addresses) > 0) {
            foreach ($addresses as $address) {

                // new object
                $newAddress = new StudentAddress();

                // set values
                $newAddress->setCity($address["city"]);
                $newAddress->setHouseNo($address["postcode"]);
                $newAddress->setPostcode($address["houseNo"]);
                $newAddress->setLine1($address["line_1"]);
                $newAddress->setLine2($address["line_2"]);

                // persist
                $em->persist($newAddress);
                $em->flush();
            }
        } else {
            $output->writeln("No addresses to upload.");
        }

        // students list
        $students = [
            [
                "surname" => "Dare",
                "firstname" => "Koby",
                "nationality" => "UK",
                "email" => "Astrid@salma.com",
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Dicki",
                "firstname" => "Kelli",
                "nationality" => "UK",
                "email" => "Ivory@ashtyn.me"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Carter",
                "firstname" => "Golden",
                "nationality" => "UK",
                "email" => "Ari@flo.tv"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Koch",
                "firstname" => "Emory",
                "nationality" => "UK",
                "email" => "Gene_Hilpert@laurie.io"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kilback",
                "firstname" => "Marjorie",
                "nationality" => "Dominican Republic",
                "email" => "Antonia.Hauck@giuseppe.tv"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Hoeger",
                "firstname" => "Ernest",
                "nationality" => "Panama",
                "email" => "Maritza_Mann@abelardo.tv"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Hudson",
                "firstname" => "Rebecca",
                "nationality" => "Chile",
                "email" => "Reynold_Ferry@bennett.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Hirthe",
                "firstname" => "Josefina",
                "nationality" => "Kyrgyzstan",
                "email" => "Augustine@cassie.tv"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Ebert",
                "firstname" => "Wanda",
                "nationality" => "Palau",
                "email" => "Amina.Farrell@charlie.net"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Denesik",
                "firstname" => "Burnice",
                "nationality" => "Kuwait",
                "email" => "Tyrese@don.ca"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Moen",
                "firstname" => "Harold",
                "nationality" => "Vatican City",
                "email" => "Neil@merlin.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Spencer",
                "firstname" => "Brennon",
                "nationality" => "Cambodia",
                "email" => "Alexandria@eva.io"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Ziemann",
                "firstname" => "Stanley",
                "nationality" => "Azerbaijan",
                "email" => "Micaela@millie.info"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Rempel",
                "firstname" => "Forest",
                "nationality" => "Seychelles",
                "email" => "Chyna_Nolan@elody.org"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Zboncak",
                "firstname" => "Gregory",
                "nationality" => "Kazakhstan",
                "email" => "Annamae_Runte@soledad.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Weimann",
                "firstname" => "Valentine",
                "nationality" => "Turks and Caicos Islands",
                "email" => "Jeromy_Blick@katrine.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Waelchi",
                "firstname" => "Alexandria",
                "nationality" => "People's Democratic Republic of Yemen",
                "email" => "Everette_Torphy@halle.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Altenwerth",
                "firstname" => "Florian",
                "nationality" => "Wake Island",
                "email" => "Adelbert.Ryan@francisca.org"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Zieme",
                "firstname" => "Faye",
                "nationality" => "Guatemala",
                "email" => "Joannie.Brown@sigurd.co.uk"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Beatty",
                "firstname" => "Raleigh",
                "nationality" => "British Antarctic Territory",
                "email" => "Alessandra_Hayes@jamal.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kuhic",
                "firstname" => "Dolly",
                "nationality" => "Paraguay",
                "email" => "Sonny@golda.net"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Koepp",
                "firstname" => "Mikel",
                "nationality" => "Liberia",
                "email" => "Rosella@cruz.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Pfannerstill",
                "firstname" => "May",
                "nationality" => "Puerto Rico",
                "email" => "Dave@carlee.me"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Douglas",
                "firstname" => "Otho",
                "nationality" => "Denmark",
                "email" => "Walter@karley.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Conroy",
                "firstname" => "Napoleon",
                "nationality" => "Afghanistan",
                "email" => "Charley.Orn@frances.co.uk"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Doyle",
                "firstname" => "Elza",
                "nationality" => "Liechtenstein",
                "email" => "Isobel@simone.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Schulist",
                "firstname" => "Maci",
                "nationality" => "United States",
                "email" => "Reginald.Klein@keshawn.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Hansen",
                "firstname" => "Kyler",
                "nationality" => "Canada",
                "email" => "Lorine@rebeka.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Conn",
                "firstname" => "Jean",
                "nationality" => "Kiribati",
                "email" => "Zackary.Dickinson@gonzalo.info"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Yost",
                "firstname" => "Reilly",
                "nationality" => "South Africa",
                "email" => "Herman@avis.me"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Quigley",
                "firstname" => "Shad",
                "nationality" => "Bhutan",
                "email" => "Roy@judah.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Quitzon",
                "firstname" => "Beatrice",
                "nationality" => "Timor-Leste",
                "email" => "Jana@herta.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Langworth",
                "firstname" => "Lonny",
                "nationality" => "New Zealand",
                "email" => "Sophia.Paucek@jamir.net"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kiehn",
                "firstname" => "Rosalinda",
                "nationality" => "Dominican Republic",
                "email" => "Gia@nestor.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Parker",
                "firstname" => "Rebekah",
                "nationality" => "Kyrgyzstan",
                "email" => "Faustino@shane.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kuhlman",
                "firstname" => "Rhoda",
                "nationality" => "Gibraltar",
                "email" => "Roel@kianna.net"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Cruickshank",
                "firstname" => "Judd",
                "nationality" => "Macau SAR China",
                "email" => "Bell@buddy.co.uk"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Yundt",
                "firstname" => "Sarah",
                "nationality" => "Papua New Guinea",
                "email" => "Marcia@noe.org"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Pacocha",
                "firstname" => "Russ",
                "nationality" => "Greenland",
                "email" => "Shakira_Kessler@moriah.co.uk"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Purdy",
                "firstname" => "Kali",
                "nationality" => "Mauritania",
                "email" => "Ignatius@madison.info"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Block",
                "firstname" => "Janick",
                "nationality" => "Belarus",
                "email" => "Lamont@david.info"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Waelchi",
                "firstname" => "Ford",
                "nationality" => "Paraguay",
                "email" => "Marta.Grimes@malinda.org"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Batz",
                "firstname" => "Francesca",
                "nationality" => "Netherlands Antilles",
                "email" => "Janie.Klocko@dallin.net"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Rogahn",
                "firstname" => "Lukas",
                "nationality" => "Cape Verde",
                "email" => "Gage.Willms@ruben.me"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Funk",
                "firstname" => "Wilhelmine",
                "nationality" => "Zimbabwe",
                "email" => "Daphne@darryl.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Nader",
                "firstname" => "Jude",
                "nationality" => "Panama Canal Zone",
                "email" => "Payton@rupert.org"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Stroman",
                "firstname" => "Frankie",
                "nationality" => "Saint Martin",
                "email" => "Saul@gia.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Jaskolski",
                "firstname" => "Mina",
                "nationality" => "Bermuda",
                "email" => "Amos_Effertz@jennie.info"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Zieme",
                "firstname" => "Mack",
                "nationality" => "Uzbekistan",
                "email" => "Martin@isabelle.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Tromp",
                "firstname" => "Celestine",
                "nationality" => "Peru",
                "email" => "Loy@evalyn.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Nitzsche",
                "firstname" => "Zella",
                "nationality" => "New Zealand",
                "email" => "Bridgette@gordon.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kuphal",
                "firstname" => "Ila",
                "nationality" => "Maldives",
                "email" => "Terrance.Rowe@mario.co.uk"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Cruickshank",
                "firstname" => "Eda",
                "nationality" => "Jamaica",
                "email" => "Abelardo@elza.ca"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Koepp",
                "firstname" => "Jaylen",
                "nationality" => "Monaco",
                "email" => "Norbert@kristian.io"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kohler",
                "firstname" => "Kristina",
                "nationality" => "Russia",
                "email" => "Aidan@nona.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Ondricka",
                "firstname" => "Sean",
                "nationality" => "Turks and Caicos Islands",
                "email" => "Kristin.Rolfson@madelyn.tv"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Leuschke",
                "firstname" => "Estelle",
                "nationality" => "Niue",
                "email" => "Chauncey.Hoeger@jeramie.tv"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Funk",
                "firstname" => "Roselyn",
                "nationality" => "Djibouti",
                "email" => "Korbin@hallie.io"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Romaguera",
                "firstname" => "Kariane",
                "nationality" => "Djibouti",
                "email" => "Jocelyn_Fadel@lauryn.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Nitzsche",
                "firstname" => "Adrian",
                "nationality" => "Guernsey",
                "email" => "Markus.Gulgowski@nicolas.tv"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Windler",
                "firstname" => "Maggie",
                "nationality" => "Guernsey",
                "email" => "Shayna.Lesch@donny.io"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Blanda",
                "firstname" => "Ken",
                "nationality" => "French Southern Territories",
                "email" => "Modesta_Aufderhar@belle.co.uk"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Reilly",
                "firstname" => "Antone",
                "nationality" => "Yemen",
                "email" => "Ford@garfield.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Cassin",
                "firstname" => "Yadira",
                "nationality" => "Mayotte",
                "email" => "Anastacio@murray.net"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Macejkovic",
                "firstname" => "Marge",
                "nationality" => "Slovakia",
                "email" => "Retha@griffin.me"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Feest",
                "firstname" => "Rogers",
                "nationality" => "Monaco",
                "email" => "Keshawn_Kuvalis@orlando.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Fadel",
                "firstname" => "Candelario",
                "nationality" => "Belarus",
                "email" => "Kailee_Casper@reina.me"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Shields",
                "firstname" => "Eldridge",
                "nationality" => "Neutral Zone",
                "email" => "Rachel_Block@olin.info"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Romaguera",
                "firstname" => "Lavina",
                "nationality" => "Canton and Enderbury Islands",
                "email" => "Cathrine@virgie.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Hessel",
                "firstname" => "Matt",
                "nationality" => "Czech Republic",
                "email" => "Skyla@gonzalo.net"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Donnelly",
                "firstname" => "Barrett",
                "nationality" => "South Korea",
                "email" => "Sheila.Abshire@david.io"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Hagenes",
                "firstname" => "Betty",
                "nationality" => "Samoa",
                "email" => "Linda@monte.me"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Schmeler",
                "firstname" => "Alphonso",
                "nationality" => "Palau",
                "email" => "Raphael_Senger@vernon.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Shields",
                "firstname" => "Selmer",
                "nationality" => "Samoa",
                "email" => "Michelle.Rice@pat.me"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kemmer",
                "firstname" => "Earl",
                "nationality" => "Niger",
                "email" => "Terry.Rau@brennan.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kunde",
                "firstname" => "Sharon",
                "nationality" => "French Guiana",
                "email" => "Julius@isabell.io"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Jacobs",
                "firstname" => "Jeffry",
                "nationality" => "Albania",
                "email" => "Juliana.Stanton@magnolia.ca"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Ritchie",
                "firstname" => "Eliane",
                "nationality" => "Chad",
                "email" => "Kaleigh.Durgan@verner.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Erdman",
                "firstname" => "Howard",
                "nationality" => "Puerto Rico",
                "email" => "Arthur_Stroman@quinn.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Schimmel",
                "firstname" => "Lance",
                "nationality" => "Serbia",
                "email" => "Dovie.Williamson@alycia.org"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Tillman",
                "firstname" => "Elliott",
                "nationality" => "Botswana",
                "email" => "Bethel@jess.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Boyle",
                "firstname" => "Emanuel",
                "nationality" => "Tokelau",
                "email" => "Claude@brent.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Feest",
                "firstname" => "Norma",
                "nationality" => "Georgia",
                "email" => "Abdullah.Terry@leonardo.net"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "O'Conner",
                "firstname" => "Jenifer",
                "nationality" => "Nepal",
                "email" => "Virgie@robert.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Towne",
                "firstname" => "Lilliana",
                "nationality" => "New Caledonia",
                "email" => "Henri@breana.org"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Padberg",
                "firstname" => "Verner",
                "nationality" => "Seychelles",
                "email" => "Florencio@barney.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Stiedemann",
                "firstname" => "Adelia",
                "nationality" => "Greece",
                "email" => "Jessika.Nader@glennie.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Turcotte",
                "firstname" => "Tristin",
                "nationality" => "Nauru",
                "email" => "Joyce_Jaskolski@emmalee.name"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Pouros",
                "firstname" => "Cooper",
                "nationality" => "Micronesia",
                "email" => "Chase_Kub@emely.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Romaguera",
                "firstname" => "Judy",
                "nationality" => "Australia",
                "email" => "Charlotte@earl.info"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Tremblay",
                "firstname" => "Maxie",
                "nationality" => "French Guiana",
                "email" => "Annamae.Upton@roma.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Barrows",
                "firstname" => "Akeem",
                "nationality" => "Mozambique",
                "email" => "Wellington@mara.ca"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Funk",
                "firstname" => "Florencio",
                "nationality" => "Malawi",
                "email" => "Kenna@vicky.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Welch",
                "firstname" => "Margarita",
                "nationality" => "Ethiopia",
                "email" => "Wellington_Cormier@novella.tv"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Legros",
                "firstname" => "Helmer",
                "nationality" => "Antigua and Barbuda",
                "email" => "Ubaldo@bessie.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Labadie",
                "firstname" => "Carole",
                "nationality" => "Martinique",
                "email" => "Josh@kelvin.io"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Klein",
                "firstname" => "Desiree",
                "nationality" => "Nepal",
                "email" => "Isidro_Homenick@jerald.biz"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Kuvalis",
                "firstname" => "Eloy",
                "nationality" => "Panama Canal Zone",
                "email" => "Annabelle_Okuneva@christelle.com"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Macejkovic",
                "firstname" => "Lucinda",
                "nationality" => "Austria",
                "email" => "Ada_Wuckert@kirk.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ],
            [
                "surname" => "Bosco",
                "firstname" => "Emilia",
                "nationality" => "São Tomé and Príncipe",
                "email" => "Yasmin@darwin.us"
                ,
                "address_id" => rand(0, 88),
                "course_id" => rand(0, 199)
            ]
        ];

        // loop addresses
        if ($students && count($students) > 0) {
            foreach ($students as $student) {

                // new object
                $newStudent = new Student();

                // set values
                $newStudent->setFirstname($student["firstname"]);
                $newStudent->setSurname($student["surname"]);
                $newStudent->setNationality($student["nationality"]);

                // get Course
                $getCourse = $this->getContainer()->get('doctrine')->getRepository(Course::class)
                    ->find($student["course_id"]);
                $newStudent->setCourse($getCourse);

                // get Address
                $getAddress = $this->getContainer()->get('doctrine')->getRepository(StudentAddress::class)
                    ->find($student["address_id"]);
                $newStudent->setAddress($getAddress);
                $newStudent->setEmail($student["email"]);

                // persist
                $em->persist($newStudent);
                $em->flush();
            }
        } else {
            $output->writeln("No student to upload.");
        }
    }
}
