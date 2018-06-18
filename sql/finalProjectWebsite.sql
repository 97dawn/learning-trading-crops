CREATE TABLE MEMBERS (
	username VARCHAR(254) NOT NULL,
    pw VARCHAR(254) NOT NULL,
    memberType VARCHAR(254) NOT NULL,
    PRIMARY KEY (username)
);

CREATE TABLE CITIES(
    city VARCHAR(254) NOT NULL,
    province VARCHAR(254) NOT NULL,
    PRIMARY KEY (city)
);

CREATE TABLE BUYERS (
    bid VARCHAR(254) NOT NULL,
    fname VARCHAR(254) NOT NULL,
	lname VARCHAR(254) NOT NULL,
    phone VARCHAR(254) NOT NULL UNIQUE,
    email VARCHAR(254) NOT NULL UNIQUE,
    streetInfo VARCHAR(254) NOT NULL,
    city VARCHAR(254) NOT NULL,
    PRIMARY KEY (bid), 
    FOREIGN KEY (bid) REFERENCES MEMBERS (username),
    FOREIGN KEY (city) REFERENCES CITIES (city)
)ENGINE=InnoDB;

CREATE TABLE FARMER_REPUTATIONS(
    avgRating INT,
    farmerRep VARCHAR(254) NOT NULL,
    PRIMARY KEY (avgRating)
);

CREATE TABLE FARMERS (
    fid VARCHAR(254) NOT NULL,
    fname VARCHAR(254) NOT NULL,
	lname VARCHAR(254) NOT NULL,
    phone VARCHAR(254) NOT NULL UNIQUE,
    email VARCHAR(254) NOT NULL UNIQUE,
    avgRating INT DEFAULT NULL,
    streetInfo VARCHAR(254) NOT NULL,
    city VARCHAR(254) NOT NULL,
    PRIMARY KEY (fid),
    FOREIGN KEY (fid) REFERENCES MEMBERS (username),
    FOREIGN KEY (avgRating) REFERENCES FARMER_REPUTATIONS (avgRating),
    FOREIGN KEY (city) REFERENCES CITIES (city)
)ENGINE=InnoDB;

CREATE TABLE IRRIGATION_METHODS (
    category VARCHAR(254) NOT NULL,
    bestIrrigation VARCHAR(254) NOT NULL,
    PRIMARY KEY(category)
);

CREATE TABLE CROPS (
	cropName VARCHAR(254) NOT NULL,
    cropType VARCHAR(254) NOT NULL,
    category VARCHAR(254) NOT NULL,
    unitToSell VARCHAR(254) NOT NULL,
    PRIMARY KEY(cropName),
    FOREIGN KEY (category) REFERENCES IRRIGATION_METHODS (category)
)ENGINE=InnoDB;

CREATE TABLE ADDITIONAL_CHARGES (
	organicTrue BOOLEAN NOT NULL,
    extraCharge INT NOT NULL,
    PRIMARY KEY(organicTrue)
);

CREATE TABLE PRODUCT_REPUTATIONS (
	avgRating INT,
    productRep VARCHAR(254) NOT NULL,
    PRIMARY KEY(avgRating)
)ENGINE=InnoDB;

CREATE TABLE PRODUCTS (
	pid INT NOT NULL AUTO_INCREMENT,
    fid VARCHAR(254) NOT NULL,
    cropName VARCHAR(254) NOT NULL,
    pricePerUnit INT NOT NULL,
    organicTrue BOOL NOT NULL,
    avgRating INT DEFAULT NULL,
    remaining FLOAT(4) NOT NULL,
    PRIMARY KEY(pid),
    FOREIGN KEY(fid) REFERENCES FARMERS(fid),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName),
    FOREIGN KEY(organicTrue) REFERENCES ADDITIONAL_CHARGES(organicTrue),
    FOREIGN KEY(avgRating) REFERENCES PRODUCT_REPUTATIONS(avgRating)
)ENGINE=InnoDB;

CREATE TABLE PRODUCT_REVIEWS (
    reviewid INT NOT NULL AUTO_INCREMENT,
	reviewAuthor VARCHAR(254) NOT NULL,
    pid INT NOT NULL,
    rating INT NOT NULL,
    reviewBody TEXT NOT NULL,
    PRIMARY KEY(reviewid),
    FOREIGN KEY(reviewAuthor) REFERENCES BUYERS(bid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE ORDERS (
    orid INT NOT NULL AUTO_INCREMENT,
    pid INT NOT NULL,
    bid VARCHAR(254) NOT NULL,
    amount FLOAT(4) NOT NULL,
    totalPrice INT NOT NULL,
    orderDate DATETIME NOT NULL,
    PRIMARY KEY (orid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid) ON DELETE CASCADE,
    FOREIGN KEY(bid) REFERENCES BUYERS(bid) 
)ENGINE=InnoDB;

CREATE TABLE STORES (
	cartid INT NOT NULL AUTO_INCREMENT,
    pid INT NOT NULL,
    bid VARCHAR(254) NOT NULL,
    amount FLOAT(4) NOT NULL,
    rawTotalPrice INT NOT NULL,
    discountRate INT NOT NULL,
    extraCharge INT NOT NULL,
    PRIMARY KEY(cartid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid) ON DELETE CASCADE,
    FOREIGN KEY(bid) REFERENCES BUYERS(bid) 
)ENGINE=InnoDB;

CREATE TABLE DISCOUNT_RATES (
    discountid INT NOT NULL AUTO_INCREMENT,
	rate INT NOT NULL,
    minQuantity INT NOT NULL,
    maxQuantity INT DEFAULT NULL,
    pid INT NOT NULL,
    PRIMARY KEY(discountid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE SUB_PRODUCTS (
	subid INT NOT NULL AUTO_INCREMENT,
    fid VARCHAR(254) NOT NULL,
    cropName VARCHAR(254) NOT NULL,
    quantityPerSub FLOAT(4) NOT NULL,
    price INT NOT NULL,
    subPeriod FLOAT(4) NOT NULL,
    PRIMARY KEY(subid),
    FOREIGN KEY(fid) REFERENCES FARMERS(fid),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName)
);

CREATE TABLE SUB_ORDERS (
	subid INT NOT NULL,
    bid VARCHAR(254) NOT NULL,
    startDate DATE NOT NULL,
    PRIMARY KEY(subid, bid),
    FOREIGN KEY(subid) REFERENCES SUB_PRODUCTS(subid) ON DELETE CASCADE,
    FOREIGN KEY(bid) REFERENCES BUYERS(bid)
);

CREATE TABLE POSTS (
	postid INT NOT NULL AUTO_INCREMENT,
    authorName VARCHAR(254) NOT NULL,
    title VARCHAR(254) NOT NULL,
    cropName VARCHAR(254) NOT NULL,
    cropInfo TEXT NOT NULL,
    uses VARCHAR(254) NOT NULL,
    disease VARCHAR(254) NOT NULL,
    postDate DATE NOT NULL,
    PRIMARY KEY(postid),
    FOREIGN KEY(authorName) REFERENCES FARMERS(fid),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName)
);

CREATE TABLE SAVED_POSTS (
	username VARCHAR(254) NOT NULL,
    postid INT NOT NULL,
    PRIMARY KEY(username, postid),
    FOREIGN KEY(username) REFERENCES MEMBERS(username),
    FOREIGN KEY(postid) REFERENCES POSTS(postid) ON DELETE CASCADE
);

CREATE TABLE POST_COMMENTS (
    commentid INT NOT NULL AUTO_INCREMENT,
	postid INT NOT NULL,
    commenterName VARCHAR(254) NOT NULL,
    commentBody TEXT NOT NULL,
    PRIMARY KEY(commentid),
    FOREIGN KEY(postid) REFERENCES POSTS(postid) ON DELETE CASCADE,
    FOREIGN KEY(commenterName) REFERENCES MEMBERS(username)
);


INSERT INTO CITIES (city, province) VALUES
('Andong', 'North Gyeongsang'),
('Ansan', 'Gyeonggi'),
('Anseong', 'Gyeonggi'),
('Anyang', 'Gyeonggi'),
('Asan', 'South Chungcheong'),
('Boryeong', 'South Chungcheong'),
('Bucheon', 'Gyeonggi'),
('Busan Metropolitan City', 'none'),
('Changwon', 'South Gyeongsang'),
('Cheonan', 'South Chungcheong'),
('Cheongju', 'South Chungcheong'),
('Chuncheon', 'Gangwon'),
('Chungju', 'North Chungcheong'),
('Daegu Metropolitan City', 'none'),
('Daejeon Metropolitan City', 'none'),
('Dangjin', 'South Chungcheong'),
('Dongducheon', 'Gyeonggi'),
('Donghae', 'Gangwon'),
('Gangneung', 'Gangwon'),
('Geoje', 'South Gyeongsang'),
('Gimcheon', 'North Gyeongsang'),
('Gimhae', 'South Gyeongsang'),
('Gimje', 'North Jeolla'),
('Gimpo', 'Gyeonggi'),
('Gongju', 'South Chungcheong'),
('Goyang', 'Gyeonggi'),
('Gumi', 'North Gyeongsang'),
('Gunpo', 'Gyeonggi'),
('Gunsan', 'North Jeolla'),
('Guri', 'Gyeonggi'),
('Gwacheon', 'Gyeonggi'),
('Gwangju Metropolitan City', 'none'),
('Gwangju', 'Gyeonggi'),
('Gwangmyeong', 'Gyeonggi'),
('Gwangyang', 'South Jeolla'),
('Gyeongju', 'North Gyeongsang'),
('Gyeongsan', 'North Gyeongsang'),
('Gyeryong', 'South Chungcheong'),
('Hanam', 'Gyeonggi'),
('Hwaseong', 'Gyeonggi'),
('Icheon', 'Gyeonggi'),
('Iksan', 'North Jeolla'),
('Incheon Metropolitan City', 'none'),
('Jecheon', 'North Chungcheong'),
('Jeongeup', 'North Jeolla'),
('Jeonju', 'North Jeolla'),
('Jeju', 'Jeju'),
('Jinju', 'South Gyeongsang'),
('Naju', 'South Jeolla'),
('Namyangju', 'Gyeonggi'),
('Namwon', 'North Jeolla'),
('Nonsan', 'South Chungcheong'),
('Miryang', 'South Gyeongsang'),
('Mokpo', 'South Jeolla'),
('Mungyeong', 'North Gyeongsang'),
('Osan', 'Gyeonggi'),
('Paju', 'Gyeonggi'),
('Pocheon', 'Gyeonggi'),
('Pohang', 'North Gyeongsang'),
('Pyeongtaek', 'Gyeonggi'),
('Sacheon', 'South Gyeongsang'),
('Sangju', 'North Gyeongsang'),
('Samcheok', 'Gangwon'),
('Sejong Metropolitan Autonomous City', 'none'),
('Seogwipo', 'Jeju'),
('Seongnam', 'Gyeonggi'),
('Seosan', 'South Chungcheong'),
('Seoul Special Metropolitan City', 'none'),
('Siheung', 'Gyeonggi'),
('Sokcho', 'Gangwon'),
('Suncheon', 'South Jeolla'),
('Suwon', 'Gyeonggi'),
('Taebaek', 'Gangwon'),
('Tongyeong', 'South Gyeongsang'),
('Uijeongbu', 'Gyeonggi'),
('Uiwang', 'Gyeonggi'),
('Ulsan Metropolitan City', 'none'),
('Wonju', 'Gangwon'),
('Yangju', 'Gyeonggi'),
('Yangsan', 'South Gyeongsang'),
('Yeoju', 'Gyeonggi'),
('Yeongcheon', 'North Gyeongsang'),
('Yeongju', 'North Gyeongsang'),
('Yeosu', 'South Jeolla'),
('Yongin', 'Gyeonggi');

INSERT INTO MEMBERS VALUES ("jsmith",   "james123", "F");
INSERT INTO MEMBERS VALUES ("pstewart", "peter123", "F");
INSERT INTO MEMBERS VALUES ("jhall",    "jhone123", "F");
INSERT INTO MEMBERS VALUES ("cmorris",  "cathy123", "F");
INSERT INTO MEMBERS VALUES ("kbell",    "katherine123", "F");
INSERT INTO MEMBERS VALUES ("ahyes",    "abigail123", "F");
INSERT INTO MEMBERS VALUES ("asanders", "addison123", "F");
INSERT INTO MEMBERS VALUES ("bcollins", "benjamin123", "F");
INSERT INTO MEMBERS VALUES ("cgriffin", "christopher123", "F");
INSERT INTO MEMBERS VALUES ("dcampbell","david123", "F");
INSERT INTO MEMBERS VALUES ("kross",    "kelly123", "B");
INSERT INTO MEMBERS VALUES ("swood",    "scott123", "B");
INSERT INTO MEMBERS VALUES ("bcooper",  "bob123", "B");
INSERT INTO MEMBERS VALUES ("kmorgan",  "kate123", "B");
INSERT INTO MEMBERS VALUES ("bperry",   "brian123", "B");
INSERT INTO MEMBERS VALUES ("dparker",  "daniel123", "B");
INSERT INTO MEMBERS VALUES ("eevans",   "elizabeth123", "B");
INSERT INTO MEMBERS VALUES ("erussell", "emily123", "B");
INSERT INTO MEMBERS VALUES ("gbryant",  "grace123", "B");
INSERT INTO MEMBERS VALUES ("lgray",    "lily123",   "B");

INSERT INTO BUYERS VALUES ("kross", "Kelly", "Ross", "010-6789-6789", "kross@gmail.com", "21 Seolleung-ro 8-gil", "Seoul Special Metropolitan City" );
INSERT INTO BUYERS VALUES ("swood", "Scott", "Wood", "010-7890-7890", "swood@gmail.com", "42 Gangdongchogyo-gil", "Gangneung" );
INSERT INTO BUYERS VALUES ("bcooper", "Bob", "Cooper", "010-8901-8901", "bcooper@gmail.com", "34 Gyeongancheon-ro 258beon-gil Cheoin-gu", "Yongin" );
INSERT INTO BUYERS VALUES ("kmorgan", "Kate", "Morgan", "010-9012-9012", "kmorgan@gmail.com", "39 Gambuk-ro", "Hanam" );
INSERT INTO BUYERS VALUES ("bperry", "Brian", "Perry", "010-0123-0123", "bperry@gmail.com", "70 Jangan-gil", "Pyeongtaek" );
INSERT INTO BUYERS VALUES ("dparker", "Daniel", "Parker", "010-1324-1324", "dparker@gmail.com", "31 Seokdae-ro Haeundae-gu", "Busan Metropolitan City" );
INSERT INTO BUYERS VALUES ("eevans", "Elizabeth", "Evans", "010-2435-2435", "eevans@gmail.com", "119 Songdomunhwa-ro Yeonsu-gu", "Incheon Metropolitan City" );
INSERT INTO BUYERS VALUES ("erussell", "Emily", "Russell", "010-3546-3546", "erussell@gmail.com", "69 Namsan-ro", "Jecheon" );
INSERT INTO BUYERS VALUES ("gbryant", "Grace", "Bryant", "010-4657-4657", "gbryant@gmail.com", "683 Donghaean-ro Dong-gu", "Ulsan Metropolitan City" );
INSERT INTO BUYERS VALUES ("lgray", "Lily", "Gray", "010-5768-5768", "lgray@gmail.com", "1 Hureung-gil Dong-gu", "Ulsan Metropolitan City" );

INSERT INTO FARMER_REPUTATIONS VALUES (1, "not recommended");
INSERT INTO FARMER_REPUTATIONS VALUES (2, "less than neutral");
INSERT INTO FARMER_REPUTATIONS VALUES (3, "neutral");
INSERT INTO FARMER_REPUTATIONS VALUES (4, "trust-worthy");
INSERT INTO FARMER_REPUTATIONS VALUES (5, "super farmer");

INSERT INTO FARMERS VALUES ("jsmith", "James", "Smith", "010-1234-1234", "jsmith@gmail.com", 5, "22 Bamgogae-ro 1-gil Gangnam-gu", "Seoul Special Metropolitan City" );
INSERT INTO FARMERS VALUES ("pstewart", "Peter", "Stewart", "010-2345-2345", "pstewart@gmail.com", 4,"14 Teheran-ro 82-gil Gangnam-gu", "Seoul Special Metropolitan City" );
INSERT INTO FARMERS VALUES ("jhall", "John", "Hall", "010-3456-3456", "jhall@gmail.com", 4, "53 Gyeongdongsijang-ro 2-gil Dongdaemun-gu", "Seoul Special Metropolitan City" );
INSERT INTO FARMERS VALUES ("cmorris", "Cathy", "Morris", "010-4567-4567", "cmorris@gmail.com", 5, "25 Dogok-ro 64-gil Songpa-gu", "Seoul Special Metropolitan City" );
INSERT INTO FARMERS VALUES ("kbell", "Katherine", "Bell", "010-5678-5678", "kbell@gmail.com", 5, "35 Ganchon-ro 27beon-gil Seo-gu", "Incheon Metropolitan City" );
INSERT INTO FARMERS VALUES ("ahyes", "Abigail", "Hayes", "010-4321-4321", "ahyes@gmail.com", 4, "578 Maesohol-ro Nam-gu", "Incheon Metropolitan City" );
INSERT INTO FARMERS VALUES ("asanders", "Addison", "Sanders", "010-5432-5432", "asanders@gmail.com", 2,"7 Hogupo-ro 889beon-gil Namdong-gu", "Incheon Metropolitan City");
INSERT INTO FARMERS VALUES ("bcollins", "Benjamin", "Collins", "010-6543-6543", "bcollins@gmail.com", 3, "20 Pyeongnae-ro 29beonan-gil", "Namyangju" );
INSERT INTO FARMERS VALUES ("cgriffin", "Christopher", "Griffin","010-7654-7654","cgriffin@gmail.com", 1, "31 Haenggung-ro 62beon-gil Paldal-gu", "Suwon");
INSERT INTO FARMERS VALUES ("dcampbell", "David", "Campbell", "010-8765-8765", "dcampbell@gmail.com", 4, "22 Chanumul 2-gil", "Siheung" );


INSERT INTO IRRIGATION_METHODS VALUES ("individual plant", "sprinkle");
INSERT INTO IRRIGATION_METHODS VALUES ("close growing", "drip");
INSERT INTO IRRIGATION_METHODS VALUES ("row crop", "surface irrigation");

INSERT INTO CROPS VALUES ("Pecan",     "nut",     "individual plant", "kg");
INSERT INTO CROPS VALUES ("Watermelon","fruit",    "row crop", "for each");
INSERT INTO CROPS VALUES ("Pumpkin",   "vegetable",    "row crop", "kg");
INSERT INTO CROPS VALUES ("Rice",      "grain",    "close growing", "kg");
INSERT INTO CROPS VALUES ("Strawberry","fruit",    "row crop", "kg");
INSERT INTO CROPS VALUES ("Tomato",    "vegetable","row crop", "kg");
INSERT INTO CROPS VALUES ("Mango",     "fruit",    "individual plant", "kg");
INSERT INTO CROPS VALUES ("Lemon",     "fruit ",   "individual plant", "kg");
INSERT INTO CROPS VALUES ("Potato",    "vegetable","row crop", "kg");
INSERT INTO CROPS VALUES ("Dill",      "herb",     "row crop", "kg");
INSERT INTO CROPS VALUES ("Eggplant",  "vegetable",    "row crop", "kg");
INSERT INTO CROPS VALUES ("Grapefruit","fruit",    "individual plant", "for each");
INSERT INTO CROPS VALUES ("Kiwi",      "fruit",    "close growing", "for each");
INSERT INTO CROPS VALUES ("Kale",      "vegetable","row crop", "kg");
INSERT INTO CROPS VALUES ("Apple",     "fruit",    "individual plant", "kg");
INSERT INTO CROPS VALUES ("Apricot",   "fruit",    "individual plant", "kg");
INSERT INTO CROPS VALUES ("Avocado",   "fruit",    "individual plant", "for each");
INSERT INTO CROPS VALUES ("Cabbage",   "vegetable","row crop", "for each");
INSERT INTO CROPS VALUES ("Carrot",    "vegetable","close growing", "kg");
INSERT INTO CROPS VALUES ("Celery",    "vegetable","row crop", "kg");
INSERT INTO CROPS VALUES ("Almond",     "nut",     "individual plant", "kg");
INSERT INTO CROPS VALUES ("Peanut",     "nut",     "row crop", "kg");
INSERT INTO CROPS VALUES ("Walnut",     "nut",     "individual plant", "kg");
INSERT INTO CROPS VALUES ("Cashew",     "nut",     "individual plant", "kg");
INSERT INTO CROPS VALUES ("Barley",      "grain",    "close growing", "kg");
INSERT INTO CROPS VALUES ("Wheat",      "grain",    "close growing", "kg");
INSERT INTO CROPS VALUES ("Oatmeal",      "grain",    "close growing", "kg");
INSERT INTO CROPS VALUES ("Millet",      "grain",    "close growing", "kg");
INSERT INTO CROPS VALUES ("Basil",      "herb",     "row crop", "kg");
INSERT INTO CROPS VALUES ("Mints",      "herb",     "row crop", "kg");
INSERT INTO CROPS VALUES ("Lavender",      "herb",     "row crop", "kg");
INSERT INTO CROPS VALUES ("Rosemary",      "herb",     "individual plant", "kg");


INSERT INTO ADDITIONAL_CHARGES VALUES (true, 1000);
INSERT INTO ADDITIONAL_CHARGES VALUES (false, 0);

INSERT INTO PRODUCT_REPUTATIONS VALUES (1, "not recommended");
INSERT INTO PRODUCT_REPUTATIONS VALUES (2, "less than average");
INSERT INTO PRODUCT_REPUTATIONS VALUES (3, "average");
INSERT INTO PRODUCT_REPUTATIONS VALUES (4, "quality guaranteed");
INSERT INTO PRODUCT_REPUTATIONS VALUES (5, "superb");

INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("jsmith", "Pecan", 20000, false , 5, 20.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("pstewart", "Apricot", 12000, false, 4, 30.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("jhall", "Pumpkin", 10000, false   , 4, 45.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("cmorris", "Rice", 24000, false     , 5, 1000.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("kbell", "Carrot", 5000, true      , 5, 30.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("ahyes", "Avocado", 2800, true     , 5, 60.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("asanders", "Cabbage", 2500, true  , 2, 80.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("bcollins", "Celery", 5000, false  , 3, 35.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("cgriffin", "Apple", 7000, true   , 1, 55.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("dcampbell", "Lemon", 5000, false , 4, 70.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("jsmith", "Rosemary",13000, true, NULL, 1000.00 );
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("pstewart", "Millet", 3000, true, NULL, 2000.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("jhall", "Oatmeal", 5000, false, NULL, 3000.00 );
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("cmorris", "Almond", 12300, false, NULL, 2500.00 );
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("kbell", "Cabbage", 4520, false, NULL, 300.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("ahyes", "Kale", 3080, true, NULL, 230.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("asanders", "Mango", 9030, false, NULL, 1230.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("bcollins", "Apple", 2400, false, NULL, 3020.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("cgriffin", "Mints", 4200, true, NULL, 250.00);
INSERT INTO PRODUCTS(fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES ("dcampbell", "Apricot", 5600, true,NULL , 4350.00);


INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("kross", 1 , 5, "These arrived fresh and intact. They are soft yet crisp as any good pecan would be.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("swood", 2 , 4, "Fresh and delicious");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("bcooper", 3 , 4, "I use this for pumpkin pie, which is my favorite pie of all. I also use it for pumpkin bread and muffins.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("kmorgan", 4 , 5, "I'm going to order it again. I really liked it!");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("bperry", 5 , 5, "Excellent!");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("dparker", 6 , 4, "I was amazed at the value here compared to our local supermarket. I would highly recommend this product to others.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("eevans", 7, 2, "They were shipped with other produce in a cardboard box with holes punched in the side. Almost all the items arrived rotten.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("erussell", 8, 3, "It's over priced for one celery");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("gbryant", 9, 1, "Probably wouldn't buy again. Most of the apples arrived mushy and turning brown.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("lgray", 10, 4, "Pretty good.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("kross", 10, 4, "These arrived fresh and intact.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("swood", 9, 1, "Not fresh.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("bcooper", 8, 3, "SO SO.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("kmorgan", 7 , 1, "I'm not going to order it again.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("bperry", 6 , 5, "Excellent!");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("dparker", 5 , 4, "I was amazed at the value here compared to our local supermarket. ");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("eevans", 4, 4, "I would highly recommend this product to others.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("erussell", 3, 4, "It's GOOD celery");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("gbryant", 2, 4, "Probably would buy again.");
INSERT INTO PRODUCT_REVIEWS(reviewAuthor, pid, rating, reviewBody) VALUES ("lgray", 1, 5, "Absolutely good.");


INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (4, "kmorgan", 10.00, 240000, '2017-06-23 18:06:02');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (7, "kmorgan", 10.00, 26000, '2017-06-23 18:06:03');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (8, "erussell", 3.00, 15000, '2017-12-01 12:30:22');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (3, "erussell", 3.00, 27000, '2017-12-01 12:30:23');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (6, "dparker", 3.00, 8560, '2018-01-11 16:23:23');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (5, "dparker", 3.00, 16000, '2018-01-11 16:23:24');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (7, "eevans", 10.00, 26000, '2018-01-12 08:09:11');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (4, "eevans", 10.00, 240000, '2018-01-12 08:09:12');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (5, "bperry", 5.00, 21000, '2018-02-07 20:11:11');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (6, "bperry", 5.00, 15000, '2018-02-07 20:11:12');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (9, "gbryant", 8.00, 57000, '2018-02-22 13:20:00');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (2, "gbryant", 8.00, 81600, '2018-02-22 13:20:01');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (3, "bcooper", 5.00, 50000, '2018-04-18 10:01:30');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (10, "lgray", 4.00, 18000, '2018-04-27 14:50:20');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (1, "kross", 2.00, 36000, '2018-05-18 13:10:01');
INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (2, "swood", 3.00, 32400, '2018-05-22 15:03:00');

INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (10, 2, 4, 1);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (15, 5, NULL, 1);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (10, 3, 7, 2);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (15, 8, NULL, 2);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (10, 2, 6, 3);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (15, 7, NULL, 3);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (10, 3, 5, 4);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (15, 6, NULL, 4);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (20, 4, NULL, 5);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (10, 2, NULL, 6);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (10, 2, NULL, 7);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (20, 6, NULL, 8);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (20, 5, NULL, 9);
INSERT INTO DISCOUNT_RATES(rate, minQuantity, maxQuantity, pid) VALUES (10, 10, NULL, 10);

INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (1, "kross", 2.00, 40000, 10, 0);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (2, "swood", 3.00, 36000, 10, 0);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (3, "bcooper", 5.00, 50000, 0, 0);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (4, "kmorgan", 10.00, 24000, 0, 0);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (5, "bperry", 5.00, 25000, 20, 1000);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (6, "dparker", 3.00, 8400, 10, 1000);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (7, "eevans", 10.00, 25000, 0, 1000);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (8, "erussell", 3.00, 15000, 0, 0);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (9, "gbryant", 8.00, 56000, 0, 1000);
INSERT INTO STORES(pid, bid, amount, rawTotalPrice, discountRate, extraCharge) VALUES (10, "lgray", 4.00, 20000, 10, 0);

INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("jsmith", "Grapefruit",   5.0,  10000,  3.0);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("pstewart", "Watermelon", 7.0,  70000,  2.0);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("jhall", "Eggplant",      8.0,  80000,  2.0);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("cmorris", "Kiwi",        10.0, 13000,  1.0);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("dcampbell", "Tomato",    12.0, 40000,  4.0);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("kbell", "Mango",         20.0, 200000, 4.25);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("ahyes", "Potato",        30.0, 150000, 6.0);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("asanders", "Dill",       5.0,  15000,  3.0);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("bcollins", "Pecan",      1.0,  20000,  2.0);
INSERT INTO SUB_PRODUCTS(fid, cropName, quantityPerSub, price, subPeriod) VALUES ("cgriffin", "Kale",       2.0,  17800,  3.0);

INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (1, "kross", '2018-02-18');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (2, "swood", '2017-03-22');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (3, "bcooper", '2018-01-20');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (4, "kmorgan", '2017-05-01');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (5, "bperry", '2016-08-15');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (6, "dparker", '2012-07-12');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (7, "eevans", '2018-01-09');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (8, "erussell", '2017-02-07');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (9, "gbryant", '2018-02-22');
INSERT INTO SUB_ORDERS(subid, bid, startDate) VALUES (10, "lgray", '2016-05-02');

INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (
                          "jsmith", 
                          "Really Fresh Pecan", 
                          "Pecan", 
                          "Plant pecan trees in a hole about 3 feet deep and 2 feet wide. Position the tree in the hole so that the soil line on the tree is even with the surrounding soil, then adjust the depth of the hole, if necessary. Begin filling the hole with soil, arranging the roots in a natural position as you go. Don’t add soil amendments or fertilizer to the fill dirt. When the hole is half full, fill it with water to remove air pockets and settle the soil. After the water drains through, fill the hole with soil. Press the soil down with your foot and then water deeply. Add more soil if a depression forms after watering. ", 
                          "snack food or may be used as an ingredient in baked goods", 
                          "Anthracnose Colletotrichum gloeospo  orides",
                          '2018-05-18');
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES ( 
                          "pstewart", 
                          "My Apricot", 
                          "Apricot", 
                          "To begin your apricot seed planting, choose a luscious mid- to late-season type of apricot, ideally one that was grown from seed itself. Eat the fruit; actually eat a few to up the chances of germination and save your pits. Scrub any flesh off and lay them out on newspaper for three hours or so to dry. Now you need to get the seed out of the pit. Use a hammer gingerly on the side of the pit to crack it. You can also use a nutcracker or vise. The idea is to get the seed out of the pit without crushing it. If you are in doubt that any of these methods will work for you, as a last resort, you can just plant the entire pit but germination will take longer. Once you have retrieved the seeds, allow them to dry on the newspaper for a few more hours. You can now store them in a cover jar or zip-top plastic bag in refrigerator to stratify the seeds for 60 days. Whether to stratify of not depends on where you obtained the fruit. If purchased from a grocery store, the fruit has already been cold stored, so it is less likely to need to stratify; but if you bought them from a farmers market or plucked them directly from a tree, it is necessary to stratify the seeds. If you are not going to stratify the seeds, wrap them in a clean, damp paper towel and place them in a plastic bag in a window. Keep an eye on it. Water as needed to keep it moist and change the paper towel if it begins to mildew.
", 
                          "jams and jellies, syrup or juice", 
                          "Armillaria root rot",
                          '2018-06-19');
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (
                          "jhall", 
                          "Do you know how to grow pumpkins?", 
                          "Pumpkin", 
                          "When you plant pumpkin seeds outside, remember that pumpkins need an incredible amount of space to grow. It’s recommended that you plan on a minimum of 20 square feet being needed for each plant. When the soil temperature is at least 65 F. (18 C.), you can plant your pumpkin seeds. Pumpkin seeds won’t germinate in cold soil. Mound the soil in the center of the chosen location up a bit to help the sun heat the pumpkin seeds. The warmer the soil, the faster the pumpkin seeds will germinate. In the mound, plant three to five pumpkin seeds about 1 inch deep. Once the pumpkin seeds germinate, select two of the healthiest and thin out the rest.", 
                          "Pumpkin flesh can be cooked and eaten in a variety of dishes", 
                          "Alternaria leaf blight", 
                          '2018-07-13');
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (
                          "cmorris", 
                          "Yummy Rice", 
                          "Rice", 
                          "Choose your planting location. Make sure the soil in the area you're planting consists of slightly acidic clay for the best results. You may also plant your rice seeds in plastic buckets with the same type of soil. Wherever you plant, make sure you have a reliable water source and a way to drain that water when you need to harvest. Gather at least 1 to 2 ounces (28.5 to 56.5 g) of rice seeds to sow. Soak the seeds in water to prep them for planting. Allow them to soak for at least 12 hours but not longer than 36 hours. Remove the seeds from the water afterward. Plant the rice seeds throughout the soil, during the fall or spring season. Get rid of the weeds, till the beds, and level the soil. If you are using buckets, fill them with at least 6 inches (15 cm) of moist soil. Then add the rice seeds.",
                          "Rice can be used as brown rice or further processed to remove the bran to produce white rice.", 
                          "Bacterial blight ", 
                          '2018-06-22');      
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES ( 
                          "kbell", 
                          "Delicious Carrot", 
                          "Carrot", 
                          "Plant your carrots in rows that are 1 to 2 feet apart is the best way how to grow carrots. Seeds should be planted about a ½ inch deep and 1 to 2 inches apart. When growing carrots in the garden, you’ll wait for your carrot plants to appear. When the plants are 4 inches high, thin the plants to 2 inches apart. You may find that some of the carrots are actually large enough to eat. Thin the carrots regularly to 4 inches apart. When growing carrots in the garden, make sure to plant, per person, five to ten feet of row to have enough carrots for table use. You will get about one pound of carrots in a one foot row. You want to keep your carrots free of weeds when growing carrots in the garden. This is never more so than when they are small. The weeds will take nutrients away from the carrots. This will cause poor carrot development.
", 
                          "Carrots are eaten as a vegetable and can be consumed fresh or cooked.", 
                          "Alternaria leaf blight", 
                          '2018-02-19'); 
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (
                          "ahyes", 
                          "Do you know Avocado?", 
                          "Avocado", 
                          "Avocados do not grow true from seed but you can get an interesting plant from starting a pit. Although many gardeners have experimented with germinating a pit in a glass of water, most avocados are propagated from tip grafting and the resulting seedlings will exhibit the characteristics of the graft wood or parent plant. Plant grafted seedlings with the graft under the soil, which is uncommon for other grafted trees. Stake young trees and keep them free of weeds while they are establishing.", 
                          "Avocado is usually consumed fresh as a fruit or as an ingredient in salads or savory dishes", 
                          "Algal leaf spot ", 
                          '2018-02-19'); 
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (
                          "asanders", 
                          "Fresh Cabbage", 
                          "Cabbage", 
                          "When growing cabbage, be sure to space the plants 12 to 24 inches apart. The closer you space your cabbage plants, the smaller the head of the cabbage will be. Early varieties of cabbage can be planted 12 inches apart and will grow one to three pound heads. The later varieties can produce heads upwards of eight pounds. Once you learn how to grow cabbage, you will have a great cabbage crop. Make sure to sow the cabbage seeds ¼ to ½ inch deep. After you sow them, keep them moist and thin them out to desired spacing once they grow. Make sure you fertilize your plants when growing cabbage, especially after transplanting. Then add nitrogen as well when the cabbage is half grown. This helps them mature better. Make sure the soil is moist throughout the growing season so your cabbage produces better heads.
", 
                          "Cabbage is primarily grown for consumption as a vegetable, eaten after boiling or steaming.", 
                          "Alternaria leaf spot",
                          '2018-04-10');                          
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (
                          "bcollins", 
                          "Celery", 
                          "Celery", 
                          "Once the temperatures outside are consistently above 50 F. (10 C.), you can plant your celery into your garden. Remember that celery is very temperature sensitive, so don’t plant it out too early or you will kill or weaken the celery plant. Unless you live in a location that is ideal to grow celery plants, plant your celery where it will get six hours of sun, but preferably somewhere that the celery plant will be shaded for the hottest part of the day. Also, make sure that where you will be growing celery has rich soil. Celery needs lots of nutrients to grow well. A growing celery plant needs a lot of water. Make sure to keep the soil evenly moist and don’t forget to water them. Celery can’t tolerate drought of any kind. If the ground isn’t kept consistently moist, it will negatively affect the taste of the celery. You’ll also need to fertilize regularly to keep up with the nutrient needs of the celery plant.
", 
                          "Celery is eaten around the world as a vegetable. Both the taproot and leaves are often used. Temperate countries grow celery for its seeds, which are often mixed with salt to make celery salt for seasoning.", 
                          "Bacterial blight and brown stem", 
                          '2018-08-13'); 
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (
                          "cgriffin", 
                          "Apple", 
                          "Apple", 
                          "One thing to remember about growing an apple tree is that the pH of the soil has to be just what the tree needs. You should have a soil test done if you are thinking about how to grow an apple orchard or your trees might not survive. Having a soil test done by the extension office is great because they provide the kit, do the test and then can give you a report of exactly what your soil needs in order to have the proper pH. Adding whatever is needed should be done to the depth of 12 to 18 inches so that the roots get the proper pH, or they can burn.", 
                          "Apples are most commonly eaten fresh but can also be used for baking and cooking. ", 
                          "Apple scab", 
                          '2018-01-13');
INSERT INTO POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (
                          "dcampbell", 
                          "Lemon", 
                          "Lemon", 
                          "Lemons are more cold-sensitive than all other citrus trees. Due to this cold sensitivity, lemon trees should be planted near the south side of the home. Lemon trees need protection from frost. Growing them near the house should help with this. Lemon trees also require full sunlight for adequate growth. While lemon trees can tolerate a range of soils, including poor soil, most prefer well-drained, slightly acidic soil. Lemon trees should be set slightly higher than ground. Therefore, dig a hole somewhat shallower than the length of the root ball. Place the tree in the hole and replace soil, tamping firmly as you go. Water sufficiently and add some mulch to help retain moisture. Lemon trees require deep watering once weekly. If necessary, pruning may be done to maintain their shape and height.", 
                          "It is used widely to make juices such as lemonade, as garnishes in cooking and as a flavoring in cooking and baking.", 
                          "Armillaria root rot", 
                          '2018-01-24');      

INSERT INTO SAVED_POSTS VALUES ("kross", 1);
INSERT INTO SAVED_POSTS VALUES ("swood", 2);
INSERT INTO SAVED_POSTS VALUES ("bcooper", 3);
INSERT INTO SAVED_POSTS VALUES ("kmorgan", 4);
INSERT INTO SAVED_POSTS VALUES ("bperry", 5);
INSERT INTO SAVED_POSTS VALUES ("dparker", 6);
INSERT INTO SAVED_POSTS VALUES ("eevans", 7);
INSERT INTO SAVED_POSTS VALUES ("erussell", 8);
INSERT INTO SAVED_POSTS VALUES ("gbryant", 9);
INSERT INTO SAVED_POSTS VALUES ("lgray", 10);

INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (1, "bcollins", "Very helpful. Thank you!");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (2, "dcampbell", "Helpful!");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (3, "kross", "This post is helpful.");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (4, "cmorris", "Like this post.");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (5, "jsmith", "Thank you!");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (6, "pstewart", "It was light green when I bought it. When can eat it?");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (7, "dparker", "Cabbage is also good source of dietary fiber.");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (8, "eevans", "How do I keep it fresh?");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (9, "erussell", "How do I prevent an apple from becoming brown?");
INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (10, "lgray", "Thank you for providing good information.");

/*
SELECT * FROM CITIES;
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
SELECT * FROM POST_COMMENTS;*/