import {ApolloDriver, ApolloDriverConfig} from "@nestjs/apollo";
import { join } from 'path';

export async function getGraphQLConfig():Promise<ApolloDriverConfig>{
    return{
        driver:ApolloDriver,
        typePaths: [join(process.cwd(), 'src/**/*.graphql')],
        context: ({req, res}) => ({req, res}),
    }
}