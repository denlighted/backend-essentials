import { Module } from '@nestjs/common';
import { StudentsService } from './students.service';
import { StudentsResolver } from './students.resolver';
import {Student, StudentSchema} from "./schemas/student.schema";
import {MongooseModule} from "@nestjs/mongoose";

@Module({
  imports: [MongooseModule.forFeature([{ name: Student.name, schema: StudentSchema }])],
  providers: [StudentsResolver, StudentsService],
})
export class StudentsModule {}
