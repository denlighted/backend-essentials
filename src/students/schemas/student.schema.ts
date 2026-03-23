import { Prop, Schema, SchemaFactory } from '@nestjs/mongoose';
import { Document } from 'mongoose';

export type StudentDocument = Student & Document;

@Schema({ timestamps: true })
export class Student {
    @Prop({ required: true })
    lastName: string;

    @Prop({ required: true })
    studentGroup: string;

    @Prop({ required: true, unique: true })
    ticketNumber: string;
}

export const StudentSchema = SchemaFactory.createForClass(Student);