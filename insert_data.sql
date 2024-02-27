-- dialect: postgres

-- Inserting data into the Book table
INSERT INTO Book (Title, Author, Genres, Language, ISBN, ImageLink) VALUES
    ('The Boy, the Mole, the Fox and the Horse', 'Charlie Mackesy', 'Fiction, Graphic Novels, Animals', 'English', '9781529105100', 'https://www.penguin.com.au/books/the-boy-the-mole-the-fox-and-the-horse-9781529105100'),
    ('Charlotte''s Web', 'E.B. White', 'Fiction, Classics, Animals', 'English', '9780064410939', 'https://classicaleducationbooks.ca/product/charlottes-web-colour-edition/'),
    ('The Secret Garden', 'Frances Hodgson Burnett', 'Fiction, Classics, Fantasy', 'English', '9780763631611', 'https://www.abebooks.com/servlet/BookDetailsPL?bi=31776667340&searchurl=isbn%3D9780763631611%26sortby%3D17&cm_sp=snippet-_-srp1-_-title1'),
    ('The Wind in the Willows', 'Kenneth Grahame', 'Fiction, Classics, Animals', 'English', '9780143039099', 'https://www.penguinrandomhouse.com/books/579742/the-wind-in-the-willows-by-kenneth-grahame-introduction-and-notes-by-gillian-avery/'),
    ('The Secret of the Old Clock (Nancy Drew Mystery Stories #1)', 'Carolyn Keene', 'Fiction, Classics, Mystery', 'English', '9781557091550', 'https://www.abebooks.com/9781557091550/Secret-Old-Clock-Nancy-Drew-1557091552/plp'),
    ('Matilda', 'Roald Dahl', 'Fiction, Classics, Comedy', 'English', '9780141301068', 'https://hub.lexile.com/find-a-book/book-details/9780141301068'),
    ('Where the Sidewalk Ends', 'Shel Silverstein', 'Poetry, Classics, Comedy', 'English', '9780060513030', 'https://www.abebooks.com/9780060513030/Where-Sidewalk-Ends-Silverstein-Shel-0060513039/plp'),
    ('Little Kids First Big Book of the World', 'Elizabeth Carney', 'Nonfiction, Geography, Education', 'English', '9781426320507', 'https://www.indigo.ca/en-ca/national-geographic-little-kids-first-big-book-of-the-world/9781426320507.html'),
    ('Charlie and the Chocolate Factory', 'Roald Dahl', 'Fiction, Classics, Fantasy', 'English', '9780425287668', 'https://ottawa.bibliocommons.com/v2/record/S26C124299'),
    ('Lost Treasure of the Emeral Eye', 'Geronimo Stilton', 'Fiction, Adventure, Mystery', 'English', '9780439559638', 'https://www.amazon.ca/Treasure-Emerald-GERONIMO-STILTON-Paperback/dp/B00QPO8FAM/ref=sr_1_3?crid=XSEVM6TCXWD1&dib=eyJ2IjoiMSJ9.l0I7FNNfbRV7aa8MpFDE5gkOFTYGlwFkaED2wYgQLc0iN4BSIgfI2_EdCT3k3bQAzo5z6WgOtxIduAg1mSJI2E8hupAzRRhKDS42mQfiLL7bBuLPUIfH_wZz_Ji2EBXjMUt_mFvZ4u8yb85TM0g_qvKXv30lhLMvcZJ9huasBcrP-xKrpCpQRwzy24mGgyUr1yfeKUvGKiFuScLV2Vp-BLHCLHmTmmJrdHJtCLRTE7o.9JnsHgEarnJtVASabm8-fDc3f15YvxRUhIqioKIzFoQ&dib_tag=se&keywords=Lost+Treasure+of+the+Emerald+Eye&qid=1708276999&s=books&sprefix=lost+treasure+of+the+emerald+eye%2Cstripbooks%2C118&sr=1-3'),
    ('Alice’s Adventures in Wonderland / Through the Looking-Glass', 'Lewis Carol', 'Fiction, Classics, Fantasy', 'English', '9780147515872', 'https://www.penguinrandomhouse.com/books/317910/alices-adventures-in-wonderland-by-lewis-carroll-illustrated-by-anna-bond/'),
    ('Tales of a Fourth Grade Nothing', 'Judy Blume', 'Fiction, Comedy', 'English', '9781417788255', 'https://www.ebay.com/itm/361885366634'),
    ('Thea Stilton and the Mystery on the Orient Express', 'Thea Stilton', 'Fiction, Adventure, Mystery', 'English', '9780545341059', 'https://www.abebooks.com/9780545341059/Thea-Stilton-Mystery-Orient-Express-0545341051/plp'),
    ('Beezus and Ramona', 'Beverly Clearly', 'Fiction, Comedy', 'English', '9780688210762', 'https://www.christianbook.com/beezus-and-ramona-repackaged/beverly-cleary/9780688210762/pd/210762'),
    ('Coraline', 'Neil Gaiman', 'Fiction, Fantasy, Horror', 'English', '9780380807345', 'https://www.abebooks.com/servlet/BookDetailsPL?bi=30176683035&searchurl=isbn%3D9780380807345%26sortby%3D17&cm_sp=snippet-_-srp1-_-image1'),
    ('Cabin Fever', 'Jeff Kinney', 'Fiction, Graphic Novels, Comedy', 'English', '9781419702235', 'https://www.indigo.ca/en-ca/cabin-fever-diary-of-a-wimpy-kid-6/9781419741913.html'),
    ('A Little Princess', 'Frances Hodgson Burnett', 'Fiction, Classics', 'English', '9780064401876', 'https://www.indigo.ca/en-ca/a-little-princess/9780064401876.html'),
    ('Bone, Vol. 1: Out from Boneville', 'Jeff Smith', 'Fiction, Graphic Novels, Adventure, Comedy', 'English', '9780439706407', 'https://www.indigo.ca/en-ca/out-from-boneville-a-graphic-novel-bone-1/9780439706407.html'),
    ('Ghosts', 'Raina Telgemeier', 'Fiction, Graphic Novels', 'English', '9781338115567', 'https://www.abebooks.com/9781338115567/Ghosts-1338115561/plp'),
    ('El Deafo', 'Cece Bell', 'Nonfiction, Graphic Novels, Memoirs', 'English', '9781419710209', 'https://www.indigo.ca/en-ca/el-deafo/9781419710209.html')
;

-- Testing data in the User table
INSERT INTO User (UserPicture, Username, Password, Email, Level) VALUES
('https://xsgames.co/randomusers/assets/images/favicon.png', 'James3', 'James3!', 'jamie3@gmail.com', 'Level 1 - Emerging Reader'),
('https://i.pinimg.com/564x/1b/14/34/1b1434c7d78bca9e24bcb89e5126903c.jpg', 'Rachel2', 'Rachel2!', 'rachelm2@gmail.com', 'Level 2 - Literary Explorer'),
('https://i.pinimg.com/236x/b4/4b/1e/b44b1e13b07e920823112b5de12a1bbe.jpg', 'Timothy3', 'Timothy3!', '1timothy3@gmail.com', 'Level 3 - Reading Wiz'),
('https://art.pixilart.com/13e07bd455dcf46.png', 'Matthew4', 'Matthew4!', 'matthewjs4@gmail.com', 'Level 4 - Page Turner,'),
('https://i.redd.it/5560va6tsg191.jpg', 'Mary', 'Mary4!', 'maryjoe4@gmail.com', 'Level 5');
;

-- Inserting data into the Review table
INSERT INTO Review (UserID, ReviewText) VALUES
    (1, 'This book was amazing! Highly recommend it.'),
    (2, 'I enjoyed reading this book. It was well-written.'),
    (3, 'Great story and characters. Really enjoyed it.'),
    (4, 'One of the best books I''ve read. Captivating from start to finish.'),
    (5, 'Not my cup of tea. Didn''t enjoy it much.'),
    (6, 'Interesting concept but execution fell short for me.');


-- Inserting data into the BookLevel table
INSERT INTO BookLevel (BookName, BookDescription, Genre, QuantityAvailable) VALUES
    ('The Boy, the Mole, the Fox and the Horse', 'A heartwarming tale of friendship and self-discovery', 'Fiction, Graphic Novels, Animals', '20'),
    ('Charlotte''s Web', 'A beloved classic about friendship and bravery', 'Fiction, Classics, Animals', '15'),
    ('The Secret Garden', 'A magical story of healing and renewal', 'Fiction, Classics, Fantasy', '18'),
    ('The Wind in the Willows', 'An enchanting adventure with memorable animal characters', 'Fiction, Classics, Animals', '12'),
    ('The Secret of the Old Clock (Nancy Drew Mystery Stories #1)', 'The first book in the iconic Nancy Drew series', 'Fiction, Classics, Mystery', '10');

-- Inserting data into the Challenge table
INSERT INTO Challenge (ChallengeName, ChallengeDescription, ChallengeDifficulty) VALUES
    ('Reading Challenge: 30 Books in 30 Days', 'Read 30 books in 30 days and share your progress with friends!', 'Hard'),
    ('Genre Exploration Challenge', 'Explore different genres by reading one book from each genre and share your insights.', 'Medium'),
    ('Author Spotlight Challenge', 'Choose an author and read all of their books within a specified time frame.', 'Medium'),
    ('Buddy Reading Challenge', 'Team up with a friend and read a book together, then discuss your thoughts.', 'Easy'),
    ('Book Review Challenge', 'Write a review for every book you read and earn badges for your insightful reviews!', 'Medium');

-- Inserting data into the Friends table
INSERT INTO Friends (FriendPicture, FriendName) VALUES
    ('https://p16-va.lemon8cdn.com/tos-maliva-v-ac5634-us/o0nqADOAnQEM0eY13JTbBdYfruAYCtQRhlIIDB~tplv-tej9nj120t-origin.webp', 'Emily Johnson'),
    ('https://img.freepik.com/free-vector/hand-drawn-side-profile-cartoon-illustration_23-2150517168.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1708905600&semt=ais', 'Michael Brown'),
    ('https://static.vecteezy.com/system/resources/previews/008/420/425/original/cute-penguin-wearing-earmuff-cartoon-icon-illustration-animal-winter-icon-concept-isolated-premium-flat-cartoon-style-vector.jpg', 'Sophia Miller'),
    ('https://thumbs.dreamstime.com/z/man-cheeky-smile-big-nose-cartoon-profile-avatar-sticker-label-flat-design-man-cheeky-smile-big-nose-cartoon-231882826.jpg', 'Noah Wilson'),
    ('https://m.media-amazon.com/images/I/31Cd9UQp6eL._AC_UF1000,1000_QL80_.jpg', 'Olivia Martinez');
