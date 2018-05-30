DROP DATABASE IF EXISTS fpdb1;

CREATE DATABASE fpdb1;

GRANT ALL PRIVILEGES ON fpdb1.* to grader@localhost IDENTIFIED BY 'allowme';

USE fpdb1;

CREATE TABLE MEMBERS (
	username VARCHAR(256) NOT NULL,
    pw VARCHAR(256) NOT NULL,
    memberType VARCHAR(256) NOT NULL,
    PRIMARY KEY (username)
);

CREATE TABLE CITIES(
    city VARCHAR(256) NOT NULL,
    province VARCHAR(256) NOT NULL,
    PRIMARY KEY (city)
);

CREATE TABLE BUYERS (
    username VARCHAR(256) NOT NULL,
    fName VARCHAR(256) NOT NULL,
	lName VARCHAR(256) NOT NULL,
    phone VARCHAR(256) NOT NULL UNIQUE,
    email VARCHAR(256) NOT NULL UNIQUE,
    streetInfo VARCHAR(256) NOT NULL,
    city VARCHAR(256) NOT NULL,
    PRIMARY KEY (username), 
    FOREIGN KEY (username) REFERENCES MEMBERS (username),
    FOREIGN KEY (city) REFERENCES CITIES (city)
);

CREATE TABLE FARMER_REPUTATIONS(
    avgRating INT NOT NULL,
    farmerRep VARCHAR(256) NOT NULL,
    PRIMARY KEY (avgRating)
);

CREATE TABLE FARMERS (
    username VARCHAR(256) NOT NULL,
    fName VARCHAR(256) NOT NULL,
	lName VARCHAR(256) NOT NULL,
    phone VARCHAR(256) NOT NULL UNIQUE,
    email VARCHAR(256) NOT NULL UNIQUE,
    avgRating INT NOT NULL,
    streetInfo VARCHAR(256) NOT NULL,
    city VARCHAR(256) NOT NULL,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES MEMBERS (username),
    FOREIGN KEY (avgRating) REFERENCES FARMER_REPUTATIONS (avgRating),
    FOREIGN KEY (city) REFERENCES CITIES (city)
);

CREATE TABLE IRRIGATION_METHODS (
    category VARCHAR(256) NOT NULL,
    bestIrrigation VARCHAR(256) NOT NULL,
    PRIMARY KEY(category)
);

CREATE TABLE CROPS (
	cropName VARCHAR(256) NOT NULL,
    cropType VARCHAR(256) NOT NULL,
    category VARCHAR(256) NOT NULL,
    unitToSell VARCHAR(256) NOT NULL,
    PRIMARY KEY(cropName),
    FOREIGN KEY (category) REFERENCES IRRIGATION_METHODS (category)
);

CREATE TABLE ADDITIONAL_CHARGES (
	organicTrue BOOL NOT NULL,
    extraCharge INT NOT NULL,
    PRIMARY KEY(organicTrue)
);

CREATE TABLE PRODUCTS (
	pid INT NOT NULL,
    username VARCHAR(256) NOT NULL,
    cropName VARCHAR(256) NOT NULL,
    pricePerUnit INT NOT NULL,
    organicTrue BOOL NOT NULL,
    avgRating INT NOT NULL,
    remaining FLOAT(4) NOT NULL,
    image BLOB,
    PRIMARY KEY(pid),
    FOREIGN KEY(username) REFERENCES FARMERS(username),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName),
    FOREIGN KEY(organicTrue) REFERENCES ADDITIONAL_CHARGES(organicTrue),
    FOREIGN KEY(avgRating) REFERENCES FARMER_REPUTATIONS(avgRating)
);

CREATE TABLE PRODUCT_REPUTATIONS (
	avgRating INT NOT NULL,
    productRep VARCHAR(256) NOT NULL,
    PRIMARY KEY(avgRating)
);

CREATE TABLE PRODUCT_REVIEWS (
    reviewid INT NOT NULL,
	reviewAuthor VARCHAR(256) NOT NULL,
    pid INT NOT NULL,
    rating INT NOT NULL,
    reviewBody TEXT NOT NULL,
    PRIMARY KEY(reviewid),
    FOREIGN KEY(reviewAuthor) REFERENCES BUYERS(username),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid) 
);

CREATE TABLE ORDERS (
	oid INT NOT NULL,
    pid INT NOT NULL,
    buyername VARCHAR(256) NOT NULL,
    amount FLOAT(4) NOT NULL,
    totalPrice INT,
    orderDate DATETIME NOT NULL,
    PRIMARY KEY(oid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid),
    FOREIGN KEY(buyername) REFERENCES BUYERS(username) 
);

CREATE TABLE STORES (
	cartid INT NOT NULL,
    pid INT NOT NULL,
    buyername VARCHAR(256) NOT NULL,
    amount FLOAT(4) NOT NULL,
    rawTotalPrice INT NOT NULL,
    discountRate INT,
    extraCharge INT NOT NULL,
    PRIMARY KEY(cartid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid),
    FOREIGN KEY(buyername) REFERENCES BUYERS(username) 
);

CREATE TABLE DISCOUNT_RATES (
    discountid INT NOT NULL,
	rate INT NOT NULL,
    minQuantity INT NOT NULL,
    maxQuantity INT NOT NULL,
    pid INT NOT NULL,
    PRIMARY KEY(discountid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid)
);

CREATE TABLE SUB_PRODUCTS (
	subid INT NOT NULL,
    username VARCHAR(256) NOT NULL,
    cropName VARCHAR(256) NOT NULL,
    quantityPerSub FLOAT(4) NOT NULL,
    price INT NOT NULL,
    period FLOAT(4) NOT NULL,
    PRIMARY KEY(subid),
    FOREIGN KEY(username) REFERENCES FARMERS(username),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName)
);

CREATE TABLE SUB_ORDERS (
	subid INT NOT NULL,
    username VARCHAR(256) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE,
    PRIMARY KEY(subid, username),
    FOREIGN KEY(subid) REFERENCES SUB_PRODUCTS(subid),
    FOREIGN KEY(username) REFERENCES BUYERS(username)
);

CREATE TABLE POSTS (
	postid INT NOT NULL,
    authorname VARCHAR(256) NOT NULL,
    title VARCHAR(256) NOT NULL,
    cropName VARCHAR(256) NOT NULL,
    description VARCHAR(256) NOT NULL,
    uses VARCHAR(256) NOT NULL,
    disease VARCHAR(256) NOT NULL,
    image BLOB,
    postDate DATE NOT NULL,
    PRIMARY KEY(postid),
    FOREIGN KEY(authorname) REFERENCES FARMERS(username),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName)
);

CREATE TABLE SAVED_POST (
	username VARCHAR(256) NOT NULL,
    postid INT NOT NULL,
    PRIMARY KEY(username, postid),
    FOREIGN KEY(username) REFERENCES MEMBERS(username),
    FOREIGN KEY(postid) REFERENCES POSTS(postid)
);

CREATE TABLE POST_COMMENTS (
    commentid INT NOT NULL,
	postid INT NOT NULL,
    comAuthor VARCHAR(256) NOT NULL,
    commentBody TEXT NOT NULL,
    PRIMARY KEY(commentid),
    FOREIGN KEY(postid) REFERENCES POSTS(postid),
    FOREIGN KEY(comAuthor) REFERENCES MEMBERS(username)
);


INSERT INTO MEMBERS VALUES ("jsmith", "james123", "F");
INSERT INTO MEMBERS VALUES ("pstewart", "peter123", "F");
INSERT INTO MEMBERS VALUES ("jhall", "jhone123", "F");
INSERT INTO MEMBERS VALUES ("cmorris", "cathy123", "F");
INSERT INTO MEMBERS VALUES ("kbell", "katherine123", "F");
INSERT INTO MEMBERS VALUES ("ahyes", "abigail123", "F");
INSERT INTO MEMBERS VALUES ("asanders", "addison123", "F");
INSERT INTO MEMBERS VALUES ("bcollins", "benjamin123", "F");
INSERT INTO MEMBERS VALUES ("cgriffin", "christopher123", "F");
INSERT INTO MEMBERS VALUES ("dcampbell", "david123", "F");
INSERT INTO MEMBERS VALUES ("kross", "kelly123", "B");
INSERT INTO MEMBERS VALUES ("swood", "scott123", "B");
INSERT INTO MEMBERS VALUES ("bcooper", "bob123", "B");
INSERT INTO MEMBERS VALUES ("kmorgan", "kate123", "B");
INSERT INTO MEMBERS VALUES ("bperry", "brian123", "B");
INSERT INTO MEMBERS VALUES ("dparker", "daniel123", "B");
INSERT INTO MEMBERS VALUES ("eevans", "elizabeth123", "B");
INSERT INTO MEMBERS VALUES ("erussell", "emily123", "B");
INSERT INTO MEMBERS VALUES ("gbryant", "grace123", "B");
INSERT INTO MEMBERS VALUES ("lgray", "lily123", "B");

INSERT INTO BUYERS VALUES ("kross", "Kelly", "Ross", "010-6789-6789", "kross@gmail.com", "21 Seolleung-ro 8-gil", "Seoul" );
INSERT INTO BUYERS VALUES ("swood", "Scott", "Wood", "010-7890-7890", "swood@gmail.com", "42 Gangdongchogyo-gil", "Gangneung" );
INSERT INTO BUYERS VALUES ("bcooper", "Bob", "Cooper", "010-8901-8901", "bcooper@gmail.com", "34 Gyeongancheon-ro 258beon-gil Cheoin-gu", "Yongin" );
INSERT INTO BUYERS VALUES ("kmorgan", "Kate", "Morgan", "010-9012-9012", "kmorgan@gmail.com", "39 Gambuk-ro", "Hanam" );
INSERT INTO BUYERS VALUES ("bperry", "Brian", "Perry", "010-0123-0123", "bperry@gmail.com", "70 Jangan-gil", "Pyeongtaek" );
INSERT INTO BUYERS VALUES ("dparker", "Daniel", "Parker", "010-1324-1324", "dparker@gmail.com", "31 Seokdae-ro Haeundae-gu", "Busan" );
INSERT INTO BUYERS VALUES ("eevans", "Elizabeth", "Evans", "010-2435-2435", "eevans@gmail.com", "119 Songdomunhwa-ro Yeonsu-gu", "Incheon" );
INSERT INTO BUYERS VALUES ("erussell", "Emily", "Russell", "010-3546-3546", "erussell@gmail.com", "69 Namsan-ro", "Jecheon" );
INSERT INTO BUYERS VALUES ("gbryant", "Grace", "Bryant", "010-4657-4657", "gbryant@gmail.com", "683 Donghaean-ro Dong-gu", "Ulsan" );
INSERT INTO BUYERS VALUES ("lgray", "Lily", "Gray", "010-5768-5768", "lgray@gmail.com", "1 Hureung-gil Dong-gu", "Ulsan" );

INSERT INTO FARMER_REPUTATIONS VALUES (1, "not recommended");
INSERT INTO FARMER_REPUTATIONS VALUES (2, "less than neutral");
INSERT INTO FARMER_REPUTATIONS VALUES (3, "neutral");
INSERT INTO FARMER_REPUTATIONS VALUES (4, "trust-worthy");
INSERT INTO FARMER_REPUTATIONS VALUES (5, "super farmer");

INSERT INTO FARMERS VALUES ("jsmith", "James", "Smith", "010-1234-1234", "jsmith@gmail.com", 1, "22 Bamgogae-ro 1-gil Gangnam-gu", "Seoul" );
INSERT INTO FARMERS VALUES ("pstewart", "Peter", "Stewart", "010-2345-2345", "pstewart@gmail.com", 2,"14 Teheran-ro 82-gil Gangnam-gu", "Seoul" );
INSERT INTO FARMERS VALUES ("jhall", "John", "Hall", "010-3456-3456", "jhall@gmail.com", 3, "53 Gyeongdongsijang-ro 2-gil Dongdaemun-gu", "Seoul" );
INSERT INTO FARMERS VALUES ("cmorris", "Cathy", "Morris", "010-4567-4567", "cmorris@gmail.com", 4, "25 Dogok-ro 64-gil Songpa-gu", "Seoul" );
INSERT INTO FARMERS VALUES ("kbell", "Katherine", "Bell", "010-5678-5678", "kbell@gmail.com", 2, "35 Ganchon-ro 27beon-gil Seo-gu", "Incheon" );
INSERT INTO FARMERS VALUES ("ahyes", "Abigail", "Hayes", "010-4321-4321", "ahyes@gmail.com", 5, "578 Maesohol-ro Nam-gu", "Incheon" );
INSERT INTO FARMERS VALUES ("asanders", "Addison", "Sanders", "010-5432-5432", "asanders@gmail.com", 3,"7 Hogupo-ro 889beon-gil Namdong-gu", "Incheon");
INSERT INTO FARMERS VALUES ("bcollins", "Benjamin", "Collins", "010-6543-6543", "bcollins@gmail.com", 2, "20 Pyeongnae-ro 29beonan-gil", "Namyangju" );
INSERT INTO FARMERS VALUES ("cgriffin", "Christopher", "Griffin","010-7654-7654","cgriffin@gmail.com", 1, "31 Haenggung-ro 62beon-gil Paldal-gu", "Suwon");
INSERT INTO FARMERS VALUES ("dcampbell", "David", "Campbell", "010-8765-8765", "dcampbell@gmail.com", 4, "22 Chanumul 2-gil", "Siheung" );


INSERT INTO IRRIGATION_METHODS VALUES ("individual plant", "sprinkle");
INSERT INTO IRRIGATION_METHODS VALUES ("close growing", "drip");
INSERT INTO IRRIGATION_METHODS VALUES ("row crop", "surface irrigation");
INSERT INTO IRRIGATION_METHODS VALUES ("category", "none");

INSERT INTO CROPS VALUES ("Pecan",     "nuts",     "category", "kg");
INSERT INTO CROPS VALUES ("Watermelon","fruit",    "category", "for each");
INSERT INTO CROPS VALUES ("Pumpkin",   "fruit",    "category", "kg");
INSERT INTO CROPS VALUES ("Rice",      "grain",    "close growing", "kg");
INSERT INTO CROPS VALUES ("Strawberry","fruit",    "category", "kg");
INSERT INTO CROPS VALUES ("Tomato",    "vegetable","category", "kg");
INSERT INTO CROPS VALUES ("Mango",     "fruit",    "category", "kg");
INSERT INTO CROPS VALUES ("Lemon",     "fruit ",   "category", "kg");
INSERT INTO CROPS VALUES ("Potato",    "vegetable","row crop", "kg");
INSERT INTO CROPS VALUES ("Dill",      "herb",     "category", "kg");
INSERT INTO CROPS VALUES ("Eggplant",  "fruit",    "category", "kg");
INSERT INTO CROPS VALUES ("Grapefruit","fruit",    "category", "for each");
INSERT INTO CROPS VALUES ("Kiwi",      "fruit",    "category", "for each");
INSERT INTO CROPS VALUES ("Kale",      "vegetable","category", "kg");
INSERT INTO CROPS VALUES ("Apple",     "fruit",    "category", "kg");
INSERT INTO CROPS VALUES ("Apricot",   "fruit",    "category", "kg");
INSERT INTO CROPS VALUES ("Avocado",   "fruit",    "category", "for each");
INSERT INTO CROPS VALUES ("Cabbage",   "vegetable","category", "for each");
INSERT INTO CROPS VALUES ("Carrot",    "vegetable","category", "kg");
INSERT INTO CROPS VALUES ("Celery",    "vegetable","category", "kg");

INSERT INTO ADDITIONAL_CHARGES VALUES (true, 1000);
INSERT INTO ADDITIONAL_CHARGES VALUES (false, 0);

INSERT INTO PRODUCTS VALUES (1, "jsmith", "Pecan", 20000, "false"    , 2, 20, NULL);
INSERT INTO PRODUCTS VALUES (2, "pstewart", "Apricot", 12000, "false", 3, 30, NULL);
INSERT INTO PRODUCTS VALUES (3, "jhall", "Pumpkin", 10000, "false"   , 1, 45, NULL);
INSERT INTO PRODUCTS VALUES (4, "cmorris", "Rice", 2400, "false"     , 4, 1000, NULL);
INSERT INTO PRODUCTS VALUES (5, "kbell", "Carrot", 5000, "true"      , 1, 30, NULL);
INSERT INTO PRODUCTS VALUES (6, "ahyes", "Avocado", 2800, "true"     , 5, 60, NULL);
INSERT INTO PRODUCTS VALUES (7, "asanders", "Cabbage", 2500, "true"  , 4, 80, NULL);
INSERT INTO PRODUCTS VALUES (8, "bcollins", "Celery", 5000, "false"  , 3, 35, NULL);
INSERT INTO PRODUCTS VALUES (9, "cgriffin", "Apple", 7000, "true"    , 2, 55, NULL);
INSERT INTO PRODUCTS VALUES (10, "dcampbell", "Lemon", 5000, "false" , 4, 70, NULL);

INSERT INTO PRODUCT_REPUTATIONS VALUES (1, "not recommended");
INSERT INTO PRODUCT_REPUTATIONS VALUES (2, "less than average");
INSERT INTO PRODUCT_REPUTATIONS VALUES (3, "average");
INSERT INTO PRODUCT_REPUTATIONS VALUES (4, "quality guaranteed");
INSERT INTO PRODUCT_REPUTATIONS VALUES (5, "superb");

INSERT INTO PRODUCT_REVIEWS VALUES (11, "kross", 1 , 2, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (22, "swood", 2 , 3, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (33, "bcooper", 3 , 4, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (44, "kmorgan", 4 , 5, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (55, "bperry", 5 , 1, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (66, "dparker", 6 , 2, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (77, "eevans", 7, 3, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (88, "erussell", 8, 4, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (99, "gbryant", 9, 3, "comment text");
INSERT INTO PRODUCT_REVIEWS VALUES (100, "lgray", 10, 4, "comment text");

INSERT INTO ORDERS VALUES (11, 1, "kross", 2.00, 40000, '2018-05-18 13:10:01');
INSERT INTO ORDERS VALUES (12, 2, "swood", 3.00, 36000, '2018-05-22 15:03:00');
INSERT INTO ORDERS VALUES (13, 3, "bcooper", 5.00, 50000, '2018-04-18 10:01:30');
INSERT INTO ORDERS VALUES (14, 4, "kmorgan", 10.00, 24000, '2017-06-23 18:06:02');
INSERT INTO ORDERS VALUES (15, 5, "bperry", 5.00, 25000, '2018-02-07 20:11:11');
INSERT INTO ORDERS VALUES (16, 6, "dparker", 3.00, 8400, '2018-01-11 16:23:23');
INSERT INTO ORDERS VALUES (17, 7, "eevans", 10.00, 25000, '2018-09-12 08:09:11');
INSERT INTO ORDERS VALUES (18, 8, "erussell", 3.00, 15000, '2017-12-01 12:30:22');
INSERT INTO ORDERS VALUES (19, 9, "gbryant", 8.00, 56000, '2018-08-22 13:20:00');
INSERT INTO ORDERS VALUES (20, 10, "lgray", 4.00, 20000, '2018-04-27 14:50:20');


INSERT INTO STORES VALUES (11, 1, "kross", 2.00, 40000, NULL, 0);
INSERT INTO STORES VALUES (12, 2, "swood", 3.00, 36000, NULL, 0);
INSERT INTO STORES VALUES (13, 3, "bcooper", 5.00, 50000, NULL, 0);
INSERT INTO STORES VALUES (14, 4, "kmorgan", 10.00, 24000, NULL, 0);
INSERT INTO STORES VALUES (15, 5, "bperry", 5.00, 25000, NULL, 1000);
INSERT INTO STORES VALUES (16, 6, "dparker", 3.00, 8400, NULL, 1000);
INSERT INTO STORES VALUES (17, 7, "eevans", 10.00, 25000, NULL, 1000);
INSERT INTO STORES VALUES (18, 8, "erussell", 3.00, 15000, NULL, 0);
INSERT INTO STORES VALUES (19, 9, "gbryant", 8.00, 56000, NULL, 1000);
INSERT INTO STORES VALUES (20, 10, "lgray", 4.00, 20000, NULL, 0);

INSERT INTO DISCOUNT_RATES VALUES (11, 10, 2, 4.00, 1);
INSERT INTO DISCOUNT_RATES VALUES (12, 10, 3, 4.00, 2);
INSERT INTO DISCOUNT_RATES VALUES (13, 10, 2, 3.00, 3);
INSERT INTO DISCOUNT_RATES VALUES (14, 10, 3, 5.00, 4);
INSERT INTO DISCOUNT_RATES VALUES (15, 20, 4, 5.00, 5);
INSERT INTO DISCOUNT_RATES VALUES (16, 10, 2, 4.00, 6);
INSERT INTO DISCOUNT_RATES VALUES (17, 10, 2, 6.00, 7);
INSERT INTO DISCOUNT_RATES VALUES (18, 20, 6, 8.00, 8);
INSERT INTO DISCOUNT_RATES VALUES (19, 20, 5, 6.00, 9);
INSERT INTO DISCOUNT_RATES VALUES (20, 10, 3, 5.00, 10);

INSERT INTO SUB_PRODUCTS VALUES (11, "jsmith", "Grapefruit",   5.0,  10000,  3.0);
INSERT INTO SUB_PRODUCTS VALUES (12, "pstewart", "Watermelon", 7.0,  70000,  2.0);
INSERT INTO SUB_PRODUCTS VALUES (13, "jhall", "Eggplant",      8.0,  80000,  2.0);
INSERT INTO SUB_PRODUCTS VALUES (14, "cmorris", "Kiwi",        10.0, 13000,  1.0);
INSERT INTO SUB_PRODUCTS VALUES (15, "dcampbell", "Tomato",    12.0, 40000,  4.0);
INSERT INTO SUB_PRODUCTS VALUES (16, "kbell", "Mango",         20.0, 200000, 4.25);
INSERT INTO SUB_PRODUCTS VALUES (17, "ahyes", "Potato",        30.0, 150000, 6.0);
INSERT INTO SUB_PRODUCTS VALUES (18, "asanders", "Dill",       5.0,  15000,  3.0);
INSERT INTO SUB_PRODUCTS VALUES (19, "bcollins", "Pecan",      1.0,  20000,  2.0);
INSERT INTO SUB_PRODUCTS VALUES (20, "cgriffin", "Kale",       2.0,  17800,  3.0);

INSERT INTO SUB_ORDERS VALUES (11, "kross", '2018-02-18', '2018-08-18');
INSERT INTO SUB_ORDERS VALUES (12, "swood", '2017-03-22', '2018-09-22');
INSERT INTO SUB_ORDERS VALUES (13, "bcooper", '2018-01-20', '2018-06-20');
INSERT INTO SUB_ORDERS VALUES (14, "kmorgan", '2017-05-01', '2018-05-01');
INSERT INTO SUB_ORDERS VALUES (15, "bperry", '2016-08-15', '2018-08-15');
INSERT INTO SUB_ORDERS VALUES (16, "dparker", '2017-07-12', '2018-07-12');
INSERT INTO SUB_ORDERS VALUES (17, "eevans", '2018-01-09', '2018-05-09');
INSERT INTO SUB_ORDERS VALUES (18, "erussell", '2018-02-07', '2019-02-07');
INSERT INTO SUB_ORDERS VALUES (19, "gbryant", '2018-02-22', '2018-08-22');
INSERT INTO SUB_ORDERS VALUES (20,"lgray", '2018-05-02', '2020-05-02');

INSERT INTO POSTS VALUES (1, 
                          "jsmith", 
                          "Pecan", 
                          "Pecan", 
                          "Pecan is a large deciduous tree in the family Juglandaceae grown for its edible seeds. It is harvested as soon as the nuts have reached maturity, when the shuck has lost its green color and has started to split.", 
                          "snack food or may be used as an ingredient in baked goods", 
                          "Anthracnose Colletotrichum gloeosporoides", 
                          NULL,
                          '2018-05-18');
INSERT INTO POSTS VALUES (2, 
                          "pstewart", 
                          "Apricot", 
                          "Apricot", 
                          "Apricot is a deciduous tree in the family Rosaceae grown for its edible fruit. Apricot becomes golden when ripe, and grow to the size of golf balls or larger. It has soft flesh when ripe and a central pit.", 
                          "jams and jellies, syrup or juice", 
                          "Armillaria root rot", 
                          NULL,
                          '2018-06-19');
INSERT INTO POSTS VALUES (3, 
                          "jhall", 
                          "Pumpkin", 
                          "Pumpkin", 
                          "Pumpkin is a short lived annual or perennial vines with branching tendrils and broad lobed leaves. It is harvested by hand when the fruit reaches full maturity.", 
                          "Pumpkin flesh can be cooked and eaten in a variety of dishes", 
                          "Alternaria leaf blight", 
                          NULL,
                          '2018-07-13');
INSERT INTO POSTS VALUES (4, 
                          "cmorris", 
                          "Rice", 
                          "Rice", 
                          "There are only two species of cultivated rice in the world, Oryza sativa (Asian rice) and Oryza glaberrima (African rice). When harvested by hand, the rice is cut using sharp knives or sickles. In some areas, rice is mechanically harvested using threshers or combines. ",
                          "Rice can be used as brown rice or further processed to remove the bran to produce white rice.", 
                          "Bacterial blight ", 
                          NULL,
                          '2018-06-22');      
INSERT INTO POSTS VALUES (5, 
                          "kbell", 
                          "Carrot", 
                          "Carrot", 
                          "Carrot is an edible, biennial herb in the family Apiaceae grown for its edible root. Carrots are generally ready to harvest after around 2–3 months when the roots have reached 1.3 cm (0.5 in) in diameter.", 
                          "Carrots are eaten as a vegetable and can be consumed fresh or cooked.", 
                          "Alternaria leaf blight", 
                          NULL,
                          '2018-02-19'); 
INSERT INTO POSTS VALUES (6, 
                          "ahyes", 
                          "Avocado", 
                          "Avocado", 
                          "Avocado is an evergreen tree in the family Lauraceae which grown for its nutritious fruit. It is Bacon in December, Hass in April, and the Reed in July", 
                          "Avocado is usually consumed fresh as a fruit or as an ingredient in salads or savory dishes", 
                          "Algal leaf spot ", 
                          NULL,
                          '2018-02-19'); 
INSERT INTO POSTS VALUES (7, 
                          "asanders", 
                          "Cabbage", 
                          "Cabbage", 
                          "Cabbage is an herbaceous annual or biennial vegetable in the family Brassicaceae grown for its edible head. It is ready to harvest when the head is fully formed and feels firm and well-packed when squeezed.", 
                          "Cabbage is primarily grown for consumption as a vegetable, eaten after boiling or steaming.", 
                          "Alternaria leaf spot",
                          NULL,
                          '2018-04-10');                          
INSERT INTO POSTS VALUES (8, 
                          "bcollins", 
                          "Celery", 
                          "Celery", 
                          "Celery is an aromatic biennial plant in the family Apicaceae grown primarily for its stalk and taproot which are used as vegetables. Celery can begin to be harvested when the stalks are about 20 cm (8 in) tall.", 
                          "Celery is eaten around the world as a vegetable. Both the taproot and leaves are often used. Temperate countries grow celery for its seeds, which are often mixed with salt to make celery salt for seasoning.", 
                          "Bacterial blight and brown stem", 
                          NULL,
                          '2018-08-13'); 
INSERT INTO POSTS VALUES (9, 
                          "cgriffin", 
                          "Apple", 
                          "Apple", 
                          "A deciduous tree in the family Rosaceae which is grown for its fruits, known as apples. Each variety of apple has its own maturation time and can be dependent upon weather conditions during the growing season.", 
                          "Apples are most commonly eaten fresh but can also be used for baking and cooking. ", 
                          "Apple scab", 
                          NULL,
                          '2018-01-13');
INSERT INTO POSTS VALUES (10, 
                          "dcampbell", 
                          "Lemon", 
                          "Lemon", 
                          "Lemon is a small evergreen tree in the family Rutaceae grown for its edible fruit which, among other things, are used in a variety of foods and drinks. Lemons are ready to pick as soon as they are yellow or yellow green in appearance and firm.", 
                          "It is used widely to make juices such as lemonade, as garnishes in cooking and as a flavoring in cooking and baking.", 
                          "Armillaria root rot", 
                          NULL,
                          '2018-01-24');      

INSERT INTO SAVED_POST VALUES ("kross", 1);
INSERT INTO SAVED_POST VALUES ("swood", 2);
INSERT INTO SAVED_POST VALUES ("bcooper", 3);
INSERT INTO SAVED_POST VALUES ("kmorgan", 4);
INSERT INTO SAVED_POST VALUES ("bperry", 5);
INSERT INTO SAVED_POST VALUES ("dparker", 6);
INSERT INTO SAVED_POST VALUES ("eevans", 7);
INSERT INTO SAVED_POST VALUES ("erussell", 8);
INSERT INTO SAVED_POST VALUES ("gbryant", 9);
INSERT INTO SAVED_POST VALUES ("lgray", 10);

INSERT INTO POST_COMMENTS VALUES (11, 1, "bcollins", "commentBody");
INSERT INTO POST_COMMENTS VALUES (12, 2, "dcampbell", "commentBody");
INSERT INTO POST_COMMENTS VALUES (13, 3, "kross", "commentBody");
INSERT INTO POST_COMMENTS VALUES (14, 4, "cmorris", "commentBody");
INSERT INTO POST_COMMENTS VALUES (15, 5, "jsmith", "commentBody");
INSERT INTO POST_COMMENTS VALUES (16, 6, "pstewart", "commentBody");
INSERT INTO POST_COMMENTS VALUES (17, 7, "dparker", "commentBody");
INSERT INTO POST_COMMENTS VALUES (18, 8, "eevans", "commentBody");
INSERT INTO POST_COMMENTS VALUES (19, 9, "erussell", "commentBody");
INSERT INTO POST_COMMENTS VALUES (20, 10, "lgray", "commentBody");

SELECT * FROM MEMBERS;
SELECT * FROM BUYERS;
SELECT * FROM FARMER_REPUTATIONS;
SELECT * FROM FARMERS;
SELECT * FROM IRRIGATION_METHODS;
SELECT * FROM CROPS;
SELECT * FROM ADDITIONAL_CHARGES;
SELECT * FROM PRODUCTS;
SELECT * FROM PRODUCT_REPUTATIONS;
SELECT * FROM PRODUCT_REVIEWS;
SELECT * FROM ORDERS;
SELECT * FROM STORES;
SELECT * FROM DISCOUNT_RATES;
SELECT * FROM SUB_PRODUCTS;
SELECT * FROM SUB_ORDERS;
SELECT * FROM POSTS;
SELECT * FROM SAVED_POST;
SELECT * FROM POST_COMMENTS;
