CREATE TABLE patients
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(255) NOT NULL,
    phone VARCHAR(15)  NOT NULL
);

CREATE TABLE bookings
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    date       DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time   TIME NOT NULL,
    comment    TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients (id),
    INDEX (date)
);

INSERT INTO patients (name, phone)
VALUES ('John Doe', '1234567890'),
       ('Jane Smith', '0987654321'),
       ('Timmy McTwister', '4123152142');

INSERT INTO bookings (patient_id, date, start_time, end_time, comment)
VALUES (1, '2024-03-10', '10:00:00', '11:00:00', 'Routine Checkup'),
       (1, '2024-03-10', '11:00:00', '12:00:00', 'Follow-up Visit'),
       (2, '2024-03-10', '11:30:00', '12:30:00', 'Consultation'),
       (3, '2024-03-10', '13:00:00', '14:00:00', null),
       (2, '2024-03-20', '12:00:00', '13:00:00', null),
       (1, '2024-03-20', '10:00:00', '14:00:00', 'test'),
       (3, '2024-03-10', '09:00:00', '10:30:00', null);










