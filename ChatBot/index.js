const Restify = require('restify');
const app = Restify.createServer({
    name: 'fun-ctions bot'
});

const token ='abcd12345';

app.use(Restify.plugins.jsonp());
app.use(Restify.plugins.bodyParser());

app.get('/', (req, res, next) =>{
    console.log(req.query);
    if(req.query['hub.mode']==='subscribe' && req.query['hub.verify_token'] === token)
    {
        
        res.end(req.query['hub.challenge']);
    } else {
        next();
    }
    
});

app.post('/', (req, res, next)=>{

});
app.listen(8080, ()=>{
    console.log("listening on port 8080");
});