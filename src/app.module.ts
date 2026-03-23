import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { StudentsModule } from './students/students.module';
import {MongooseModule} from "@nestjs/mongoose";
import {ConfigModule, ConfigService} from "@nestjs/config";
import {GraphQLModule} from "@nestjs/graphql";
import {getGraphQLConfig} from "./config/graphql.config";
import {ApolloDriver} from "@nestjs/apollo";

@Module({
  imports: [MongooseModule.forRootAsync({
    useFactory: (config: ConfigService) => ({
      uri: config.getOrThrow<string>('DATABASE_URI'),
    }),
    inject: [ConfigService],
  }),
    ConfigModule.forRoot({
      isGlobal: true,
    }),
    GraphQLModule.forRootAsync({
      useFactory:getGraphQLConfig,
      driver:ApolloDriver,
    })
    ,StudentsModule],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
