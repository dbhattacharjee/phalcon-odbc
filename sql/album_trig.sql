CREATE TRIGGER "Trig_Album_Id" BEFORE INSERT ON PUB."Album" FOR EACH ROW BEGIN   SELECT "Seq_Album_Id".NEXTVAL INTO :New."Id" FROM DUAL; END;
