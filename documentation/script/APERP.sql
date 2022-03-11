CREATE TABLE "users" (
  "id" SERIAL PRIMARY KEY,
  "email" varchar(180),
  "roles" json,
  "password" varchar,
  "firstname" varchar(100),
  "lastname" varchar(100),
  "pseudo" varchar(100),
  "address" text,
  "postal_code" varchar(5),
  "town" varchar(100),
  "is_valide" boolean,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "article" (
  "id" SERIAL PRIMARY KEY,
  "author_id" integer,
  "title" varchar(50),
  "description" varchar(200),
  "content" text,
  "slug" varchar,
  "file" varchar,
  "created_at" timestamp,
  "updated_at" timestamp,
  "is_published" boolean,
  "votes" integer
);

CREATE TABLE "category" (
  "id" SERIAL PRIMARY KEY,
  "name" varchar(50),
  "description" varchar
);

CREATE TABLE "comment" (
  "id" SERIAL PRIMARY KEY,
  "pseudo" varchar(100),
  "message" text,
  "is_valide" boolean,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "article_category" (
  "article_id" int,
  "category_id" int
);

ALTER TABLE "article_category" ADD FOREIGN KEY ("article_id") REFERENCES "article" ("id");

ALTER TABLE "article_category" ADD FOREIGN KEY ("category_id") REFERENCES "category" ("id");

ALTER TABLE "article" ADD FOREIGN KEY ("author_id") REFERENCES "users" ("id");

ALTER TABLE "comment" ADD FOREIGN KEY ("id") REFERENCES "article" ("id");

ALTER TABLE "users" ADD FOREIGN KEY ("id") REFERENCES "comment" ("pseudo");
