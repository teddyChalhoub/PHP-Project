import express from "express";
import productRoute from "./routes/Product-route";
import mongoose from "mongoose";
import { connectDB } from "./db";

const app = express();
app.use(express.json());
app.use('/product', productRoute);

const dbConnection = async () => {
    await connectDB();
    app.listen(5000, () => console.log("listening at port 5000"));
}

dbConnection();



