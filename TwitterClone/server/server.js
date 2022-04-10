const express = require("express")
const mongoose = require("mongoose")
const cors = require("cors")
require("dotenv").config()

app = express()

// setup middleware
app.use(cors())
app.use(express.json())

const PORT = process.env.PORT || 3000

//db connection
mongoose.connect(process.env.MONGO_URI,
    { useNewYrlParser: true, useUnifiedTopology: true, useFindAndModify: false },
    () => console.log("DB is connected"));

//db schema
const WailSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
    },
    content: {
        type: String,
        required: true,
    },
    tags: [String]
}, {timestamps: true, bufferCommands: false})

let Wail = mongoose.model("Wail", WailSchema);

//helper function
function isValidWail(body) {
    return (body.name && body.name.trim() != "" && body.content && body.content.trim() != "")
}



app.get("/",(req, res) => {
    res.json({message: "I'm working"});
});

function tagParser(text){
    return text.match(/#()[a-z0-9]{1,30}/gi);
}

app.post("/wail", async (req, res) => {
    if(isValidWail(req.body)){
        let name = req.body.name.toString();
        let content = req.body.content.toString();
        let tags = tagParser(content);

        try {
            let wail = await Wail.create({
                name,
                content,
                tags,
            });
            res.json(wail);
        }catch(err) {
            res.json({ err });
        }   
    }else{
        res.status(400);
        res.json({message:"Invalid Request"});
    }
});


app.get("/wail", async (req, res) => {
    let tag = req.query.tags ? "#" + req.query.tags : undefined;
    let name = req.query.name;
    let wail;
    
    try {
        if (tag){
            wail = await Wail.find({tags: tag}).exec();
        }else if (name){
            wail = await Wail.find({name: name}).exec();
        }else {
            wail = await Wail.find({}).exec();
        }
    
        res.json({wail, count: wail.length});
    }catch (err) {
        res.json({ err });
    }
    
});

app.listen(PORT, () => console.log(`Listening on port ${PORT}...`));