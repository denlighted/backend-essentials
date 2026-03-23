import { Injectable } from '@nestjs/common';
import {Student, StudentDocument} from "./schemas/student.schema";
import {InjectModel} from "@nestjs/mongoose";
import {Model} from "mongoose";

@Injectable()
export class StudentsService {
    constructor(@InjectModel(Student.name) private readonly studentModel: Model<StudentDocument>) {}

    async findAll(): Promise<Student[]> {
        return this.studentModel.find().exec();
    }

    async findOne(id: string): Promise<Student|null> {
        return this.studentModel.findById(id).exec();
    }

    async create(lastName: string, studentGroup: string, ticketNumber: string): Promise<Student> {
        const newStudent = new this.studentModel({ lastName, studentGroup, ticketNumber });
        return newStudent.save();
    }

    async update(id: string, updateData: any): Promise<Student|null> {
        return this.studentModel.findByIdAndUpdate(id, updateData, { new: true }).exec();
    }

    async delete(id: string): Promise<string> {
        await this.studentModel.findByIdAndDelete(id).exec();
        return id;
    }
}
